<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LdapAuthenticationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('ldap')->check()) {
            // User is authenticated via LDAP, proceed
            return $next($request);
        }

        // LDAP authentication failed, redirect to login
        return redirect(route('login'))->with('error', 'LDAP authentication failed');
    }
}