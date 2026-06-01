<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pakan extends Model
{
    use HasFactory;

    protected $table = 'pakan';

    protected $fillable = [
        'sapi_id',
        'nama_pakan',
        'stok',
        'stok_awal',
        'satuan',
        'tanggal_pemberian',
        'keterangan'
    ];

    public function sapi()
    {
        return $this->belongsTo(Sapi::class, 'sapi_id');
    }
}
