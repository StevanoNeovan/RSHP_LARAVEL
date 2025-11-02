<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsDokter
{
    public function handle(Request $request, Closure $next): Response
    {
      
        if (!Auth::check()) {
            return redirect()->route('login');
        }

      
        $userRole = session('user_role');

       
        if ($userRole == 2) {
            return $next($request);
        }

        return back()->with('error', 'Akses hanya untuk Dokter.');
    }
}
