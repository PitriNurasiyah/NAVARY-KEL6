<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SiklusSapi extends Model
{
    use HasFactory;

    protected $table = 'siklus_sapi';

    protected $fillable = [
        'sapi_id',
        'fase',
        'tanggal_mulai',
        'estimasi_selesai',
        'hari_ke',
        'status',
        'keterangan'
    ];

    public function sapi()
    {
        return $this->belongsTo(Sapi::class, 'sapi_id');
    }
}
