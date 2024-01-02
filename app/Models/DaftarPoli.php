<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarPoli extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pasien',
        'id_jadwal',
        'keluhan',
        'no_antrian',
    ];

    public static function generateNoAntrian()
    {
        $lastQueue = self::orderBy('created_at', 'desc')->first();

        $newQueueNumber = $lastQueue ? $lastQueue->no_antrian + 1 : 1;

        return $newQueueNumber;
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal');
    }
    public function periksa()
    {
        return $this->hasMany(Periksa::class, 'id_daftar_poli');
    }

}
