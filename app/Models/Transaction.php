<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // 🌟 INI YANG HARUS DIPERBARUI: Daftarkan SEMUA kolom baru di sini!
    protected $fillable = [
        'invoice_code', 
        'admin_id', 
        'customer_id', 
        'service_id', 
        'weight',             // <--- Tambahan untuk Berat (Kg/Pcs)
        'total_price', 
        'status', 
        'payment_method', 
        'payment_status', 
        'payment_proof', 
        'clothes_photo',      // <--- Tambahan untuk Foto Pakaian Masuk (Before)
        'photo_dicuci',       // <--- Tambahan untuk Foto Dicuci
        'photo_disetrika',    // <--- Tambahan untuk Foto Disetrika
        'photo_siap',         // <--- Tambahan untuk Foto Siap Diambil
        'photo_diambil',      // <--- Tambahan untuk Foto Diambil
        'photo',              // <--- Tambahan untuk Foto Fallback Umum
        'paid_at'
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}