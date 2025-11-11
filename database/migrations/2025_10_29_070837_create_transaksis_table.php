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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('id_akun');
            $table->string('item');
            $table->enum('metode_pembayaran', ['Transfer Bank', 'E-Wallet', 'Pulsa', 'Kartu Kredit']);
            $table->integer('jumlah_diamond');
            $table->decimal('harga', 15, 2);
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->decimal('diskon', 5, 2)->default(0)->nullable(); // Diskon dalam persen (0-100)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
