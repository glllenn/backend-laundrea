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
            'service_id' => 'required|exists:services,id',
            'weight' => 'required|numeric|min:0.1', 
            'payment_method' => 'required|in:cash,transfer',
            'payment_proof' => 'required_if:payment_method,transfer|image|mimes:jpeg,png,jpg|max:5120',
            'clothes_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:5120' 
        ]);

        $service = Service::findOrFail($request->service_id);
        $total_price = $service->price * $request->weight;

        $payment_proof_path = null;
        $payment_status = 'pending';
        $paid_at = null;

        if ($request->payment_method === 'transfer' && $request->hasFile('payment_proof')) {
            $payment_proof_path = $request->file('payment_proof')->store('payment_proofs', 'public');
            $payment_status = 'paid';
            $paid_at = now();
        } elseif ($request->payment_method === 'cash') {
            $payment_status = 'paid';
            $paid_at = now();
        }

        // Proses Upload Foto Baju Masuk
        $clothes_photo_path = null;
        if ($request->hasFile('clothes_photo')) {
            $clothes_photo_path = $request->file('clothes_photo')->store('clothes_photos', 'public');
        }

        $lastTransaction = Transaction::orderBy('id', 'desc')->first();
        $nextId = $lastTransaction ? $lastTransaction->id + 1 : 1;
        $invoice_code = 'LND-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

        $transaction = Transaction::create([
            'invoice_code' => $invoice_code,
            'admin_id' => $request->user()->id,
            'customer_id' => $request->customer_id,
            'service_id' => $request->service_id,
            'weight' => $request->weight,
            'total_price' => $total_price,
            'status' => 'antrian',
            'payment_method' => $request->payment_method,
            'payment_status' => $payment_status,
            'payment_proof' => $payment_proof_path,
            'clothes_photo' => $clothes_photo_path,
            'paid_at' => $paid_at
        ]);

        // Format URL Foto sebelum dikembalikan
        $transaction = $this->formatPhotoUrls($transaction);

        return response()->json([
            'success' => true, 
            'message' => 'Transaksi berhasil dibuat', 
            'data' => $transaction
        ], 201);
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