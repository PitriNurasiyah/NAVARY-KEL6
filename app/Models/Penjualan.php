<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';
    
    protected $fillable = [
        'tanggal',
        'pembeli',
        'jenis_produk',
        'jumlah',
        'harga_satuan',
        'total_harga'
    ];
}
