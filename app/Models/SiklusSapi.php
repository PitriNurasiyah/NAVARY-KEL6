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

    public function getHariKeAttribute($value)
    {
        if ($this->status === 'Berjalan' && $this->tanggal_mulai) {
            $start = \Carbon\Carbon::parse($this->tanggal_mulai);
            $today = \Carbon\Carbon::today();
            if ($today->greaterThanOrEqualTo($start)) {
                return $start->diffInDays($today) + 1;
            }
            return 1;
        }
        return $value ?? 0;
    }

    protected static function booted()
    {
        static::saving(function ($model) {
            if ($model->status !== 'Berjalan' && $model->tanggal_mulai) {
                $start = \Carbon\Carbon::parse($model->tanggal_mulai);
                $endDate = \Carbon\Carbon::today();
                if ($model->estimasi_selesai) {
                    $est = \Carbon\Carbon::parse($model->estimasi_selesai);
                    if ($est->lt($endDate)) {
                        $endDate = $est;
                    }
                }
                if ($endDate->greaterThanOrEqualTo($start)) {
                    $model->hari_ke = $start->diffInDays($endDate) + 1;
                } else {
                    $model->hari_ke = 1;
                }
            }
        });
    }
}
