<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwals = Jadwal::all();
        $dokters = Dokter::all();
        return view('dokter.jadwal-periksa', compact('jadwals', 'dokters'));
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
        $request->validate(

            [
                'id_dokter' => 'required',
                'hari' => 'required',
                'jam_mulai' => 'required',
                'jam_selesai' => 'required',
            ],
            [
                'id_dokter.required' => 'Dokter tidak boleh kosong',
                'hari.required' => 'Hari tidak boleh kosong',
                'jam_mulai.required' => 'Jam Mulai tidak boleh kosong',
                'jam_selesai.required' => 'Jam Selesai tidak boleh kosong',
            ]
        );

        $dokter = Dokter::find($request->id_dokter);
        $jadwal = Jadwal::create([
            'id_dokter' => $dokter->id,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);
        $jadwal->dokter()->associate($dokter);
        $jadwal->save();

        return redirect()->route('jadwalperiksa')->with('success', 'Jadwal berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $request->validate(

            [
                'id_dokter' => 'required',
                'hari' => 'required',
                'jam_mulai' => 'required',
                'jam_selesai' => 'required',
            ],
            [
                'id_dokter.required' => 'Dokter tidak boleh kosong',
                'hari.required' => 'Hari tidak boleh kosong',
                'jam_mulai.required' => 'Jam Mulai tidak boleh kosong',
                'jam_selesai.required' => 'Jam Selesai tidak boleh kosong',
            ]
        );

        $dokter = Dokter::find($request->id_dokter);
        $jadwal = Jadwal::find($id);
        $jadwal->update([
            'id_dokter' => $dokter->id,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->route('jadwalperiksa')->with('success', 'Jadwal berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Jadwal::destroy($id);
        return redirect()->route('jadwalperiksa')->with('success', 'Jadwal berhasil dihapus');
    }
}
