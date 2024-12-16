<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $primaryKey = 'kode_kategori';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_kategori',
        'nama_kategori',
        'jenis',
    ];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'kode_kategori', 'kode_kategori');
    }

    
}
