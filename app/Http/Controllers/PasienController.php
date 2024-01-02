<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pasiens = Pasien::all();
        // Patient does not exist, generate a new no_rm
        $dateCode = Carbon::now()->format('ym');
        $lastPatient = Pasien::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();
        $no_rm = $dateCode . '-' . str_pad($lastPatient + 1, 3, '0', STR_PAD_LEFT);
        return view('admin.pasien', compact('pasiens', 'no_rm'));
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

                'nama' => 'required',
                'alamat' => 'required',
                'no_hp' => 'required',
                'no_ktp' => 'required|unique:pasiens',
                'no_rm' => 'required',
            ],
            [

                'nama.required' => 'Nama tidak boleh kosong',
                'alamat.required' => 'Alamat tidak boleh kosong',
                'no_hp.required' => 'No HP tidak boleh kosong',
                'no_ktp.required' => 'No KTP tidak boleh kosong',
                'no_ktp.unique' => 'No KTP sudah terdaftar',
                'no_rm.required' => 'No RM tidak boleh kosong',
            ]
        );

        $pasien = Pasien::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'no_ktp' => $request->no_ktp,
            'no_rm' => $request->no_rm,
        ]);
        $pasien->save();

        return redirect()->route('pasien')->with('success', 'Data Pasien Berhasil Ditambahkan');
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

                'nama' => 'required',
                'alamat' => 'required',
                'no_hp' => 'required',
                'no_ktp' => 'required',
                'no_rm' => 'required',
            ],
            [

                'nama.required' => 'Nama tidak boleh kosong',
                'alamat.required' => 'Alamat tidak boleh kosong',
                'no_hp.required' => 'No HP tidak boleh kosong',
                'no_ktp.required' => 'No KTP tidak boleh kosong',
                'no_rm.required' => 'No RM tidak boleh kosong',
            ]
        );

        $pasien = Pasien::find($id);
        $pasien->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'no_ktp' => $request->no_ktp,
            'no_rm' => $request->no_rm,
        ]);

        return redirect()->route('pasien')->with('success', 'Data Pasien Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pasien::destroy($id);
        return redirect()->route('pasien')->with('success', 'Data Pasien Berhasil Dihapus');
    }
}
