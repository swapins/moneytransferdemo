<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ReconfirmPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
            // Check if the user is authenticated
            if (Auth::check()) {
                // Display the password reconfirmation form
                if (!session('reconfirming_password')) {
                    return redirect()->route('reconfirm-password-form');
                }
    
                // Clear the session flag to prevent reconfirmation on subsequent requests
                session()->forget('reconfirming_password');
            }
    
        
        return $next($request);
    }
}
