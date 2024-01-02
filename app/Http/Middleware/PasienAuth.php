<?php

namespace App\Http\Middleware;

use App\Models\Pasien;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasienAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('no_ktp')) {
            return redirect()->route('pasien.login');
        }

        return $next($request);
    }
}
