<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AutoLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            $user = User::where('email', 'sammy@gmail.com')->first() 
                    ?? User::first();
            if ($user) {
                Auth::login($user);
            }
        }
        return $next($request);
    }
}
