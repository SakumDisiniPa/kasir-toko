<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjualan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'pelanggan_id',
        'nomor_transaksi',
        'tanggal',
        'total',
        'tunai',
        'kembalian',
        'status',
        'subtotal',
        'pajak'
    ];
}
