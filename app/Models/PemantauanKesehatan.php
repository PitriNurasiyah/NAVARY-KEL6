<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PemantauanKesehatan extends Model
{
    protected $fillable = [
        'sapi_id',
        'tanggal',
        'kondisi_sekarang',
        'tindakan_perawatan',
        'catatan_perkembangan'
    ];

    public function sapi()
    {
        return $this->belongsTo(Sapi::class);
    }
}
