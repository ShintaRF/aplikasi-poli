<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pasien extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'alamat',
        'no_ktp',
        'no_hp',
        'no_rm',
    ];

    public static function generateNoRM()
    {
        $dateCode = now()->format('ym');
        $lastPatient = self::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->count();
        return $dateCode . '-' . str_pad($lastPatient + 1, 3, '0', STR_PAD_LEFT);
    }

    public function getAuthIdentifierName()
    {
        return 'no_ktp'; // Make sure this matches the actual field name in your database
    }

    public function daftarPoli()
    {
        return $this->hasMany(DaftarPoli::class, 'id_pasien');
    }
}
