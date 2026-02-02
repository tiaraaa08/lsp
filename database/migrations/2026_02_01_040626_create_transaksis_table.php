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
            $table->integer('id_layanan');
            $table->integer('id_pelanggan');
            $table->integer('berat');
            $table->integer('jumlah_bayar');
            $table->date('tanggal_transaksi');
            $table->enum('keterangan', ['Proses', 'Selesai']);
            $table->enum('pembayaran', ['Belum Bayar', 'Lunas']);
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
