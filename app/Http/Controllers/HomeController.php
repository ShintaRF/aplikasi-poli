<?php

namespace App\Http\Controllers;

use App\Models\DetailPeriksa;
use App\Models\Dokter;
use App\Models\Jadwal;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Periksa;
use App\Models\Poli;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function dokter()
    {
        $jadwals = Jadwal::count();
        $periksas = Periksa::count();
        $detailperiksas = DetailPeriksa::count();
        return view('dokter.dashboard', compact('jadwals', 'periksas', 'detailperiksas'));
    }

    public function admin()
    {
        $dokters = Dokter::count();
        $pasiens = Pasien::count();
        $polis = Poli::count();
        $obats = Obat::count();
        return view('admin.dashboard', compact('dokters', 'pasiens', 'polis', 'obats'));
    }
}
