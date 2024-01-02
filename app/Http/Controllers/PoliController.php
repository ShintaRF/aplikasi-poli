<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $polis = Poli::all();
        return view('admin.poli', compact('polis'));
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
                'nama_poli' => 'required',
                'keterangan' => 'required',
            ],
            [
                'nama_poli.required' => 'Nama Poli tidak boleh kosong',
                'keterangan.required' => 'Keterangan tidak boleh kosong',
            ]
        );

        $poli = Poli::create([
            'nama_poli' => $request->nama_poli,
            'keterangan' => $request->keterangan,
        ]);
        $poli->save();

        return redirect()->route('poli')->with('success', 'Data Poli Berhasil Ditambahkan');
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
                'nama_poli' => 'required',
                'keterangan' => 'required',
            ],
            [
                'nama_poli.required' => 'Nama Poli tidak boleh kosong',
                'keterangan.required' => 'Keterangan tidak boleh kosong',
            ]
        );

        $poli = Poli::find($id);
        $poli->update([
            'nama_poli' => $request->nama_poli,
            'keterangan' => $request->keterangan,
        ]);
        return redirect()->route('poli')->with('success', 'Data Poli Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Poli::destroy($id);
        return redirect()->route('poli')->with('success', 'Data Poli Berhasil Dihapus');
    }
}
