<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasienRegistrationController extends Controller
{
    public function login()
    {
        if (session()->has('no_ktp')) {
            return redirect()->route('pasien.daftarpoli');
        }
        return view('pasien.login.index');
    }

    public function loginPasien(Request $request)
    {
        $credentials = $request->validate([
            'no_ktp' => 'required',
        ]);

        $pasien = Pasien::where('no_ktp', $credentials['no_ktp'])->first();

        if ($pasien) {
            $request->session()->put('no_ktp', $credentials['no_ktp']);

            return redirect()->route('pasien.daftarpoli');
        }

        return back()->with('loginError', 'Pasien tidak ditemukan, silahkan daftar terlebih dahulu');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('pasien.login');
    }


    public function register()
    {
        if (session()->has('no_ktp')) {
            return redirect()->route('pasien.daftarpoli');
        }
        return view('pasien.register.index');
    }

    public function registerPasien(Request $request)
    {
        $request->validate(
            [

                'nama' => 'required',
                'alamat' => 'required',
                'no_hp' => 'required',
                'no_ktp' => 'required|unique:pasiens',
            ],
            [
                'nama.required' => 'Nama tidak boleh kosong',
                'alamat.required' => 'Alamat tidak boleh kosong',
                'no_hp.required' => 'No HP tidak boleh kosong',
                'no_ktp.required' => 'No KTP tidak boleh kosong',
                'no_ktp.unique' => 'No KTP sudah terdaftar',
            ]
        );

        $no_rm = Pasien::generateNoRM();

        $pasien = Pasien::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'no_ktp' => $request->no_ktp,
            'no_rm' => $no_rm,
        ]);
        $pasien->save();
        $pasienCheck = Pasien::where('no_ktp', $request->no_ktp)->first();

        if ($pasienCheck) {
            $request->session()->put('no_ktp', $request->no_ktp);

            return redirect()->route('pasien.daftarpoli');
        }
        return redirect()->route('pasien.login');
    }

}
