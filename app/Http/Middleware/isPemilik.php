<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsPemilik
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userRole = session('user_role');

    
        if ($userRole == 5 || $userRole == 'pemilik') {
            return $next($request); 
        }

        
        return back()->with('error', 'Akses hanya untuk Pemilik.');
    }
}