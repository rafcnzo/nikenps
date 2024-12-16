<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

<<<<<<< HEAD
    protected $table = 'products'; // Tabel di database
    protected $primaryKey = 'no_produk'; // Kolom primary key
    public $incrementing = false; // Primary key bukan auto increment
    protected $keyType = 'string'; // Tipe primary key string
=======
    protected $table = 'products';
    protected $primaryKey = 'id_produk';
    public $incrementing = false;
    protected $keyType = 'integer';
>>>>>>> 3ce2993d9aba089a8f551cc95207d9b01d54ed86

    protected $fillable = [
        'id_produk',
        'kode_kategori',
        'nama_produk',
        'gambar_produk',
        'stok',
    ];

<<<<<<< HEAD

    // Relasi dengan tabel kategori (optional)
=======
>>>>>>> 3ce2993d9aba089a8f551cc95207d9b01d54ed86
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kode_kategori', 'kode_kategori');
    }
    // Relasi dengan detail transaksi
    public function detailTransaksi()
    {
        return $this->hasMany(Detail_transaksi::class, 'no_produk', 'no_produk');
    }
}
