<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Service;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    // 🌟 HELPER FUNGSI (JURUS SAKTI): 
    // Otomatis merakit Full URL Foto dengan IP Laptop (biar HP gak kebingungan)
    private function formatPhotoUrls($transaction)
    {
        $baseUrl = request()->getSchemeAndHttpHost(); // Otomatis nangkap http://192.168.x.x:8000
        
        $photoFields = [
            'payment_proof', 'clothes_photo', 'photo_dicuci', 
            'photo_disetrika', 'photo_siap', 'photo_diambil', 'photo'
        ];
        
        foreach ($photoFields as $field) {
            if ($transaction->$field && !str_starts_with($transaction->$field, 'http')) {
                // Rakit IP + /storage/ + nama_file
                $transaction->$field = $baseUrl . '/storage/' . $transaction->$field;
            }
        }
        return $transaction;
    }

    // 1. Mengambil semua data transaksi (untuk tabel Web Admin)
    public function index(Request $request)
    {
        $query = Transaction::with(['customer.user', 'service', 'admin'])->latest();

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $transactions = $query->get();
        
        // Format semua URL Foto
        $transactions->map(function ($trx) {
            return $this->formatPhotoUrls($trx);
        });
        
        return response()->json(['success' => true, 'data' => $transactions]);
    }

    // 2. Mengambil transaksi khusus milik customer yang sedang login (TAMPIL DI HP)
    public function customerTransactions(Request $request)
    {
        $user = $request->user();
        $customer = Customer::where('user_id', $user->id)->first();

        // Kalau akun ini bukan pelanggan, kembalikan kosong
        if (!$customer) {
            return response()->json(['success' => true, 'data' => []]);
        }

        // Ambil transaksi khusus pelanggan ini, WAJIB bawa data 'service'
        $transactions = Transaction::with(['service'])
            ->where('customer_id', $customer->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Format semua URL Foto agar HP bisa ngebaca!
        $transactions->map(function ($trx) {
            return $this->formatPhotoUrls($trx);
        });

        return response()->json(['success' => true, 'data' => $transactions]);
    }

    // 3. Membuat Transaksi Baru (Kasir Web)
public function store(Request $request)
{
    $request->validate([
        'customer_id' => 'required|exists:customers,id',
        'payment_method' => 'required|in:cash,transfer',
        'payment_proof' => $request->payment_method === 'transfer' ? 'required|image|max:5120' : 'nullable|image|max:5120', // Wajib jika transfer
        'clothes_photo' => 'nullable|image|max:5120',
        'items' => 'required|json', // Menerima data item berupa string JSON array
    ]);

    $items = json_decode($request->items, true);

    if (empty($items)) {
        return response()->json(['success' => false, 'message' => 'Minimal harus memilih 1 layanan.'], 422);
    }

    // Validasi isi item anti-minus di tingkat server
    foreach ($items as $item) {
        if (!isset($item['qty']) || floatval($item['qty']) <= 0) {
            return response()->json(['success' => false, 'message' => 'Kuantitas layanan tidak boleh kosong atau bernilai minus.'], 422);
        }
    }

    // Gunakan DB::transaction untuk mengamankan proses insert ganda
    $transaction = \DB::transaction(function () use ($request, $items) {
        // 1. Hitung total keseluruhan berdasarkan subtotal item
        $totalPrice = 0;
        foreach ($items as $item) {
            $service = \App\Models\Service::findOrFail($item['service_id']);
            $totalPrice += $service->price * floatval($item['qty']);
        }

        // 2. Buat data induk transaksi
        $trx = new \App\Models\Transaction();
        $trx->customer_id = $request->customer_id;
        $trx->payment_method = $request->payment_method;
        $trx->total_price = $totalPrice;
        $trx->status = 'antrian';
        $trx->payment_status = $request->payment_method === 'transfer' ? 'paid' : 'unpaid';

        if ($request->hasFile('clothes_photo')) {
            $trx->clothes_photo = $request->file('clothes_photo')->store('transactions', 'public');
        }
        if ($request->hasFile('payment_proof')) {
            $trx->payment_proof = $request->file('payment_proof')->store('payments', 'public');
        }
        $trx->save();

        // 3. Simpan item-item layanan ke tabel transaction_items
        foreach ($items as $item) {
            $service = \App\Models\Service::findOrFail($item['service_id']);
            $trx->items()->create([
                'service_id' => $item['service_id'],
                'qty' => $item['qty'],
                'price' => $service->price,
                'subtotal' => $service->price * floatval($item['qty']),
            ]);
        }   

        return $trx;
    });

    return response()->json(['success' => true, 'message' => 'Transaksi berhasil dibuat', 'data' => $transaction]);
}

// Tambahkan rute fungsi destroy untuk menangani penghapusan transaksi per ID
public function destroy($id)
{
    $transaction = \App\Models\Transaction::findOrFail($id);
    $transaction->delete(); // Otomatis menghapus item jika cascade onDelete di-set

    return response()->json(['success' => true, 'message' => 'Transaksi berhasil dihapus.']);
}

    // 4. Update Status Cucian & Lampiran Foto (Web Admin)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:antrian,dicuci,disetrika,siap diambil,diambil',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'photo_dicuci' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'photo_disetrika' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'photo_siap' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'photo_diambil' => 'nullable|image|mimes:jpeg,png,jpg|max:5120'
        ]);

        $transaction = Transaction::findOrFail($id);
        $updateData = ['status' => $request->status];

        $uploadedFile = $request->file('photo') 
                     ?: $request->file('photo_dicuci') 
                     ?: $request->file('photo_disetrika') 
                     ?: $request->file('photo_siap') 
                     ?: $request->file('photo_diambil');

        if ($uploadedFile) {
            $photoPath = $uploadedFile->store('progress_photos', 'public');
            
            if ($request->status === 'dicuci') {
                $updateData['photo_dicuci'] = $photoPath;
            } elseif ($request->status === 'disetrika') {
                $updateData['photo_disetrika'] = $photoPath;
            } elseif ($request->status === 'siap diambil') {
                $updateData['photo_siap'] = $photoPath;
            } elseif ($request->status === 'diambil') {
                $updateData['photo_diambil'] = $photoPath;
            }

            // FALLBACK PENTING
            $updateData['photo'] = $photoPath;
        }

        $transaction->update($updateData);

        // Format URL Foto sebelum dikembalikan
        $transaction = $this->formatPhotoUrls($transaction);

        return response()->json([
            'success' => true, 
            'message' => 'Status transaksi berhasil diupdate', 
            'data' => $transaction
        ]);
    }

    // 5. API Laporan Dashboard
    public function dashboardStats()
    {
        $total_revenue = Transaction::whereIn('payment_method', ['cash', 'transfer'])->sum('total_price');
        $total_transactions = Transaction::count();
        $total_customers = \App\Models\Customer::count();

        return response()->json([
            'success' => true,
            'data' => [
                'revenue' => $total_revenue,
                'transactions' => $total_transactions,
                'customers' => $total_customers
            ]
        ]);
    }
}