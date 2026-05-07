<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProduksiSusu extends Model
{
    use HasFactory;

    protected $table = 'produksi_susu';

    protected $fillable = [
        'sapi_id',
        'tanggal',
        'jumlah_pagi',
        'jumlah_sore',
        'total'
    ];

    public function sapi()
    {
        return $this->belongsTo(Sapi::class, 'sapi_id');
    }
}
