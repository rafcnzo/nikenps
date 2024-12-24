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
        Schema::create('detail_transaksi', function (Blueprint $table) {
<<<<<<< HEAD
            $table->integer('id_transaksi');
            $table->string('no_produk', 15);
            $table->string('nama_produk', 35)->nullable();
            $table->integer('qty')->nullable();
<<<<<<< HEAD
=======
            $table->string('service', 35)->nullable();
=======
            $table->unsignedBigInteger('id_transaksi');
            $table->integer('id_produk');
            $table->integer('qty')->nullable();
>>>>>>> 3ce2993d9aba089a8f551cc95207d9b01d54ed86
>>>>>>> a842d03ed64d55314ff9f1ed0e3236010b29e6a4
            $table->string('harga', 35)->nullable();
            $table->string('sub_total', 25)->nullable();
            $table->timestamps();

            $table->foreign('id_transaksi')->references('id_transaksi')->on('transaksi')->onDelete('cascade');
<<<<<<< HEAD
            $table->foreign('no_produk')->references('no_produk')->on('products')->onDelete('cascade');
        });

=======
            $table->foreign('id_produk')->references('id_produk')->on('products')->onDelete('cascade');
        });
>>>>>>> 3ce2993d9aba089a8f551cc95207d9b01d54ed86
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaksi');
    }
};
