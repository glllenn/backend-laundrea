<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// 1. IMPORT SEMUA CONTROLLER DI SINI
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\ProfileController;

// Route Publik (Halaman Login aja yang boleh diakses tanpa kunci)
Route::post('/login', [AuthController::class, 'login']);

// Route Terproteksi (WAJIB di dalam kurung kurawal group ini biar aman!)
Route::middleware('auth:sanctum')->group(function () {
    
    // ==========================================
    // Auth & Profile (SUDAH DITAMBAHKAN FITUR EDIT & PASSWORD)
    // ==========================================
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::put('/profile', [ProfileController::class, 'update']); // <-- TAMBAH INI: Untuk simpan hasil Edit Profil
    Route::post('/change-password', [ProfileController::class, 'changePassword']); // <-- TAMBAH INI: Untuk Ganti Password

    // 2. LOKET MASTER DATA
    Route::apiResource('services', ServiceController::class);
    Route::apiResource('customers', CustomerController::class);

    // 3. TRANSAKSI (KHUSUS ADMIN)
    Route::get('transactions', [TransactionController::class, 'index']);
    Route::post('transactions', [TransactionController::class, 'store']);
    Route::patch('transactions/{id}/status', [TransactionController::class, 'updateStatus']);
    
    // Rute Laporan Dashboard
    Route::get('dashboard-stats', [TransactionController::class, 'dashboardStats']);

    // 4. ROUTE KHUSUS MOBILE APP (PELANGGAN)
    Route::get('status-laundry', [TransactionController::class, 'customerTransactions']);
});