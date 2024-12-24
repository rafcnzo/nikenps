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

    protected $table = 'transaksi'; // Nama tabel
    protected $primaryKey = 'id_transaksi'; // Primary Key
    public $incrementing = false; // Primary key tidak auto-increment
    protected $keyType = 'integer'; // Tipe primary key
    protected $fillable = [
        'id_transaksi', 'tanggal_transaksi', 'nama_pelanggan', 'Keterangan_Service', 'servis', 'total_harga'
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
