<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_code', 50)->unique(); 
            $table->foreignId('admin_id')->constrained('users'); 
            $table->foreignId('customer_id')->constrained('customers'); 
            $table->foreignId('service_id')->constrained('services'); 
            
            // 🌟 INI YANG BIKIN ERROR BERAT (KG) SEBELUMNYA: Kolom weight ditambahkan
            $table->decimal('weight', 8, 2)->default(0); 

            $table->decimal('total_price', 12, 2); 
            $table->enum('status', ['antrian', 'dicuci', 'disetrika', 'siap diambil', 'diambil'])->default('antrian'); 
            $table->enum('payment_method', ['cash', 'transfer']); 
            $table->enum('payment_status', ['pending', 'paid'])->default('pending'); 
            $table->string('payment_proof')->nullable(); 

            // 🌟 INI YANG BIKIN ERROR FOTO TIDAK MUNCUL: Kolom foto ditambahkan
            $table->string('clothes_photo')->nullable(); // Foto baju masuk (Before)
            $table->string('photo_dicuci')->nullable();  // Foto saat dicuci
            $table->string('photo_disetrika')->nullable(); // Foto saat disetrika
            $table->string('photo_siap')->nullable();    // Foto saat siap
            $table->string('photo_diambil')->nullable(); // Foto saat diambil
            $table->string('photo')->nullable();         // Foto fallback general

            $table->timestamp('paid_at')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};