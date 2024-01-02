<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;

class LoginController extends Controller
{
    public function indexAdmin()
    {
        return view('admin.login.index');
    }
    public function indexDokter()
    {
        return view('dokter.login.index');
    }

    public function authenticateAdmin(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                $request->session()->regenerate();

                return redirect()->intended('/admin');
            } else {
                // Logout the user if they have the wrong role
                Auth::logout();

                return back()->with('loginError', 'Invalid role for admin login!');
            }
        }

        return back()->with('loginError', 'Login gagal!');
    }

    public function authenticateDokter(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role === 'dokter') {
                $request->session()->regenerate();

                return redirect()->intended('/dokter');
            } else {
                // Logout the user if they have the wrong role
                Auth::logout();

                return back()->with('loginError', 'Invalid role for dokter login!');
            }
        }

        return back()->with('loginError', 'Login gagal!');
    }

    public function logoutAdmin(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function logoutDokter(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('dokter.login');
    }

    public function signup()
    {
        return view('register.index');
    }

    public function signupStore(Request $request)
    {
        $request->validate([
            'nama_lengkap' => ['required'],
            'alamat' => ['required'],
            'no_hp' => ['required'],
            'no_ktp' => ['required'],
            'role' => ['required'],
            'username' => ['required', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'no_ktp' => $request->no_ktp,
            'role' => $request->role,
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect('/');
    }
}
