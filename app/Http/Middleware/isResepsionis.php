<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isResepsionis
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // jika user tidak terautentikasi
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        // ambil user dari session
        $userRole = session('user_role');

        // jika user terautentikasi tapi role 1.return 403
        if ($userRole === '1') {

            return $next($request);
        } else {
            return back()->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
    }

}
