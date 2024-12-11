<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Tenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }
    
        $role = Auth::user()->role;
    
        // Redirect based on user role
        switch ($role) {
            case 'owner':
                return redirect()->route('owner.dashboard');
            case 'staff':
                return redirect()->route('staff.dashboard');     
            case 'tenant':
                return $next($request);
            case 'admin':
                return redirect()->route('admin.dashboard');
            default:
                // Optionally handle any undefined roles
                return redirect()->route('login'); // or another route
        }
    }
}
