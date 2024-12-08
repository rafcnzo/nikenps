<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id_produk';
    public $incrementing = false;
    protected $keyType = 'integer';

    protected $fillable = [
        'id_produk',
        'kode_kategori',
        'nama_produk',
        'gambar_produk',
        'stok',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kode_kategori', 'kode_kategori');
    }
}
