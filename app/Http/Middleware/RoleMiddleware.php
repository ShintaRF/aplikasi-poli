<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!auth()->check()) {
            if ($role === 'admin') {
                return redirect('/admin/login');
            }
            return redirect('/dokter/login');
        }

        $user = auth()->user();

        if ($user->role !== $role) {
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}
