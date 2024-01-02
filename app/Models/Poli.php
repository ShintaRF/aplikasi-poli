<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_poli',
        'keterangan',
    ];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'id_poli');
    }
}
