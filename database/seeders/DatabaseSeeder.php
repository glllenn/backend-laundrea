<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
   public function run(): void
    {
        // 1. Membuat Akun Admin
        User::create([
            'name' => 'Admin Laundry',
            'email' => 'admin@laundry.com',
            'password' => Hash::make('password123'), // Password default
            'role' => 'admin',
        ]);

        // 2. Membuat Data Layanan (Services)
        Service::create([
            'service_name' => 'kiloan',
            'price' => 8000.00,
            'unit' => 'Kg',
        ]);

        Service::create([
            'service_name' => 'satuan',
            'price' => 15000.00,
            'unit' => 'Pcs',
        ]);
    }
}
