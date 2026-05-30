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
        'tanggal_lahir',
        'berat',
        'status_kesehatan',
        'ayah',
        'ibu'
    ];

    //menghitung umur sapi
    public function getUmurAttribute()
    {
        if (!$this->tanggal_lahir) {
            return '-';
        }
        $dob = \Carbon\Carbon::parse($this->tanggal_lahir);
        $diff = $dob->diff(now());
        
        $umurStr = '';
        if ($diff->y > 0) {
            $umurStr .= $diff->y . ' Tahun ';
        }
        if ($diff->m > 0) {
            $umurStr .= $diff->m . ' Bulan';
        }
        if (empty(trim($umurStr))) {
            $umurStr = $diff->d . ' Hari';
        }
        
        return trim($umurStr);
    }

    public function pemantauanKesehatan()
    {
        return $this->hasMany(PemantauanKesehatan::class);
    }

    public function siklusSapi()
    {
        return $this->hasMany(SiklusSapi::class);
    }
}
