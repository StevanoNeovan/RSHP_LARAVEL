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
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
     
        $userRole = session('user_role');

       
        if ($userRole == 4) {

            return $next($request);
        } else {
            return back()->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
    }

}
