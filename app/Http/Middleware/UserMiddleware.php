<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    public function handle($request, Closure $next) {
        if(Auth::check() && Auth::user()->blocked) {
            $banned = Auth::user()->blocked == "1";
            Auth::logout();

            if($banned == 1) {
                $message = 'Your acount is blocked, please contact an administrator';
            }
            return redirect()->route('login')
                ->with('status', $message)
                ->withErrors(['email'=> 'Your account has been blocked']);
        }
        return $next($request);
    }

}
