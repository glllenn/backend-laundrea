<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;
use App\Models\User;

class ProfileController extends Controller
{
    // 1. MENGAMBIL DATA PROFIL (KODE ASLI UTUH)
    public function show(Request $request)
    {
        // Mengambil data user yang sedang login, sekaligus menarik data di tabel customers
        $user = $request->user()->load('customer');

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil dimuat',
            'data' => $user
        ]);
    }

    // 2. UPDATE DATA PROFIL & KONTAK (REAL-TIME NYAMBUNG KE WEB ADMIN)
    public function update(Request $request)
    {
        $user = $request->user();

        // Validasi data input yang dikirim dari Mobile App
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone'   => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        try {
            // A. Update data di tabel Users (Nama & Email) -> Langsung berubah di Web Admin
            $user->update([
                'name'  => $request->name,
                'email' => $request->email,
            ]);

            // B. Update atau Buat data di tabel Customers (No WhatsApp & Alamat)
            Customer::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'phone'   => $request->phone,
                    'address' => $request->address,
                ]
            );

            // Ambil ulang data user beserta customer terbaru untuk dikirim balik ke HP
            $updatedUser = User::with('customer')->find($user->id);

            return response()->json([
                'success' => true,
                'message' => 'Profil dan Informasi Kontak berhasil diperbarui!',
                'data'    => $updatedUser
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()
            ], 500);
        }
    }

    // 3. GANTI PASSWORD REAL KE DATABASE
    public function changePassword(Request $request)
    {
        $user = $request->user();

        // Validasi input password dari HP
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password'     => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        // Cek apakah password lama cocok dengan password di database
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Password saat ini salah!'
            ], 400);
        }

        try {
            // Amankan password baru menggunakan Hash::make sebelum disimpan
            $user->update([
                'password' => Hash::make($request->new_password)
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Password berhasil diubah!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengubah password: ' . $e->getMessage()
            ], 500);
        }
    }
}