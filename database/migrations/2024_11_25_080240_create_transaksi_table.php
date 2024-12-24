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
        Schema::create('transaksi', function (Blueprint $table) {
<<<<<<< HEAD
            $table->integer('id_transaksi')->primary();;
            $table->date('tanggal_transaksi')->nullable();
            $table->string('nama_pelanggan', 15)->nullable();
<<<<<<< HEAD
            $table->string('Keterangan_Service', 15)->nullable();
            $table->decimal('total_harga', 25)->nullable();
            $table->decimal('servis', 35)->nullable();
=======
=======
            $table->bigIncrements('id_transaksi');
            $table->date('tanggal_transaksi')->nullable();
            $table->string('nama_pelanggan', 35)->nullable();
            $table->string('plat_nomor', 15)->nullable();
>>>>>>> 3ce2993d9aba089a8f551cc95207d9b01d54ed86
            $table->string('total_harga', 25)->nullable();
>>>>>>> a842d03ed64d55314ff9f1ed0e3236010b29e6a4
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
