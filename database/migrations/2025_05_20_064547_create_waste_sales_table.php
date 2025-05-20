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
        Schema::create('waste_sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('waste_type');
            $table->double('weight'); // dalam kg
            $table->double('price_per_kg');
            $table->double('total_price');
            $table->text('notes')->nullable();
            $table->string('photo_path')->nullable(); // untuk Cloudinary
            $table->string('status')->default('menunggu verifikasi'); // status awal otomatis
            $table->date('sale_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waste_sales');
    }
};
