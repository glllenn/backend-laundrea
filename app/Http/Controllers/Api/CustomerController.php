<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::with('user')->latest();

        // Logika Fitur Rekomendasi: Pencarian Cepat
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('phone', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
        }

        $customers = $query->get();
        return response()->json(['success' => true, 'data' => $customers]);
    }

    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'phone' => 'required|numeric',
            'address' => 'required|string'
        ]);

        // Gunakan DB Transaction biar kalau gagal satu, gagal semua (aman)
        DB::beginTransaction();
        try {
            // 2. Buat "Kunci Gembok" (Akun Login) di tabel users
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'customer'
            ]);

            // 3. Buat "Buku Alamat" di tabel customers
            $customer = Customer::create([
                'user_id' => $user->id,
                'phone' => $request->phone,
                'address' => $request->address
            ]);

            DB::commit(); // Simpan permanen ke database

            // Load relasi user untuk dikembalikan ke frontend
            $customer->load('user');

            return response()->json([
                'success' => true, 
                'message' => 'Pelanggan berhasil ditambahkan', 
                'data' => $customer
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua jika ada error
            return response()->json([
                'success' => false, 
                'message' => 'Gagal menambahkan pelanggan', 
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Customer $customer)
    {
        return response()->json(['success' => true, 'data' => $customer->load('user')]);
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'phone' => 'sometimes|required|numeric',
            'address' => 'sometimes|required|string'
        ]);

        DB::beginTransaction();
        try {
            if ($request->has('name')) {
                $customer->user->update(['name' => $request->name]);
            }
            $customer->update($request->only(['phone', 'address']));
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Data diupdate', 'data' => $customer->load('user')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Gagal update'], 500);
        }
    }

    public function destroy(Customer $customer)
    {
        try {
            $user = $customer->user;
            
            // Hapus profil pelanggan dulu, baru hapus akun login-nya
            $customer->delete();
            if ($user) {
                $user->delete();
            }

            return response()->json(['success' => true, 'message' => 'Pelanggan berhasil dihapus']);
        } catch (\Illuminate\Database\QueryException $e) {
            // Tangkap error jika data masih dipakai di tabel transaksi
            return response()->json([
                'success' => false, 
                'message' => 'Gagal! Pelanggan ini tidak bisa dihapus karena masih memiliki riwayat transaksi.'
            ], 500);
        }
    }
}