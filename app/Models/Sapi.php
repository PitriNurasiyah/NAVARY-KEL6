<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sapi extends Model
{
    use HasFactory;

    protected $table = 'biodata_sapi';

    protected $fillable = [
        'kode_sapi',
        'nama',
        'jenis',
        'jenis_kelamin',
        'umur',
        'berat',
        'status_kesehatan'
    ];
}
