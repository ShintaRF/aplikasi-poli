<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obats = Obat::all();
        return view('admin.obat', compact('obats'));
    }

    public function getObatList()
    {
        $obats = Obat::all();

        return response()->json(['obats' => $obats]);
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
                'nama_obat' => 'required',
                'kemasan' => 'required',
                'harga' => 'required|numeric|digits_between:1,10',
            ],
            [
                'nama_obat.required' => 'Nama Obat tidak boleh kosong',
                'kemasan.required' => 'Kemasan tidak boleh kosong',
                'harga.required' => 'Harga tidak boleh kosong',
                'harga.numeric' => 'Harga harus berupa angka',
                'harga.digits_between' => 'Harga maksimal 10 digit',
            ]
        );

        $obat = Obat::create([
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,
            'harga' => $request->harga,
        ]);
        $obat->save();

        return redirect()->route('obat')->with('success', 'Data Obat Berhasil Ditambahkan');
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
                'nama_obat' => 'required',
                'kemasan' => 'required',
                'harga' => 'required|numeric|digits_between:1,10',
            ],
            [
                'nama_obat.required' => 'Nama Obat tidak boleh kosong',
                'kemasan.required' => 'Kemasan tidak boleh kosong',
                'harga.required' => 'Harga tidak boleh kosong',
                'harga.numeric' => 'Harga harus berupa angka',
                'harga.digits_between' => 'Harga maksimal 10 digit',
            ]
        );

        $obat = Obat::find($id);
        $obat->update([
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,
            'harga' => $request->harga,
        ]);

        return redirect()->route('obat')->with('success', 'Data Obat Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Obat::destroy($id);
        return redirect()->route('obat')->with('success', 'Data Obat Berhasil Dihapus');
    }
}
