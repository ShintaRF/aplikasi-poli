<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\Jadwal;
use App\Models\Pasien;
use App\Models\Poli;
use Illuminate\Http\Request;

class DaftarPoliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $polis = Poli::all();
        $jadwals = Jadwal::all();

        $no_ktp = session('no_ktp');

        $pasien = Pasien::where('no_ktp', $no_ktp)->first();

        return view('pasien.daftar-poli', compact('polis', 'jadwals', 'pasien'));

    }

    public function getJadwals(Request $request)
    {
        $poliID = $request->id_poli;

        $jadwals = Jadwal::whereHas('dokter', function ($q) use ($poliID) {
            $q->where('id_poli', $poliID);
        })->with('dokter')->get();

        return $jadwals;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_poli' => 'required',
            'id_jadwal' => 'required',
            'keluhan' => 'required',
        ], [
            'id_poli.required' => 'Pilih Poli',
            'id_jadwal.required' => 'Pilih Jadwal',
            'keluhan.required' => 'Keluhan harus diisi',
        ]);

        $idPasien = Pasien::where('no_ktp', session('no_ktp'))->first()->id;

        $daftarPoli = DaftarPoli::create([
            'id_pasien' => $idPasien,
            'id_jadwal' => $request->id_jadwal,
            'keluhan' => $request->keluhan,
            'no_antrian' => DaftarPoli::generateNoAntrian(),
        ]);
        $daftarPoli->save();
        $noAntrian = $daftarPoli->no_antrian;
        return redirect()->route('pasien.selesai', $daftarPoli->id)->with('success', 'Pendaftaran Berhasil, No Antrian Anda adalah ' . $noAntrian);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function selesai($id)
    {
        $daftarPoli = DaftarPoli::where('id', $id)->first();

        return view('pasien.thanks', compact('daftarPoli'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
