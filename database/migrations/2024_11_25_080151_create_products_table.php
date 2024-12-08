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
        Schema::create('products', function (Blueprint $table) {
            $table->integer('id_produk')->primary();
            $table->string('kode_kategori', 5);
            $table->string('nama_produk', 35)->nullable();
            $table->binary('gambar_produk');
            $table->integer('stok')->nullable();
            $table->timestamps();

            $table->foreign('kode_kategori')->references('kode_kategori')->on('kategori')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
