<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Jika user belum login, redirect ke login
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Jika tidak ada role yang ditentukan, lanjutkan request
        if (empty($roles)) {
            return $next($request);
        }

        // Cek apakah user memiliki role yang diizinkan
        if (! in_array($user->role, $roles)) {
            // Redirect berdasarkan role user
            return $this->redirectBasedOnRole($user->role);
        }

        return $next($request);
    }

    /**
     * Redirect user berdasarkan role mereka
     */
    private function redirectBasedOnRole($role)
    {
        switch ($role) {
            case 'admin':
                return redirect('/admin')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
            case 'pengemudi':
                return redirect('/pengemudi')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
            case 'orang_tua':
                return redirect('/orang_tua')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
            default:
                return redirect('/')->with('error', 'Role tidak dikenali.');
        }
    }
}
