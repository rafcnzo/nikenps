<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Factories\HasFactory;
=======
>>>>>>> 3ce2993d9aba089a8f551cc95207d9b01d54ed86
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
<<<<<<< HEAD
    use HasFactory;

    // Tentukan nama tabel jika tidak menggunakan nama konvensional
    protected $table = 'transaksi';

    protected $primaryKey = 'id_transaksi'; 

    // Tentukan kolom mana yang bisa diisi menggunakan mass-assignment
    protected $fillable = [
        'id_transaksi',
        'tanggal_transaksi',
        'nama_pelanggan',
        'total_harga'
    ];

    // Jika tidak menggunakan auto increment pada id
    public $incrementing = false;

    // Tentukan tipe data untuk kolom id_transaksi
    protected $keyType = 'integer';

    // Tentukan format tanggal yang digunakan pada kolom tanggal_transaksi
    protected $dates = [
        'tanggal_transaksi',
    ];
    
    // Relasi dengan detail transaksi
    public function detailTransaksi()
    {
        return $this->hasMany(Detail_transaksi::class, 'id_transaksi', 'id_transaksi');
=======
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';

    protected $fillable = [
        'tanggal_transaksi',
        'nama_pelanggan',
        'plat_nomor',
        'total_harga',
    ];

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi', 'id_transaksi');
>>>>>>> 3ce2993d9aba089a8f551cc95207d9b01d54ed86
    }
}
