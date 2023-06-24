<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorizeAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->user_type === 'A') {
            return $next($request);
        }

        if ($request->expectsJson()) {
            return abort(403, 'You are not an administrator.');
        }

        return redirect()->route('home')
            ->with('alert-msg', 'You are not an administrator.')
            ->with('alert-type', 'danger');
    }
}
