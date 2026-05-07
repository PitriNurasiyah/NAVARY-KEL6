<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pakan extends Model
{
    use HasFactory;

    protected $table = 'pakan';

    protected $fillable = [
        'nama_pakan',
        'stok',
        'satuan',
        'tanggal_pemberian',
        'keterangan'
    ];
}
