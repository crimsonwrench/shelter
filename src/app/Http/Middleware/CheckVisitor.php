<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckVisitor
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
        if (Auth::guard('web')->check()) {
            return $next($request);
        }

        $user = User::where('ip', $request->ip())->first();

        if (!$user) {
            $user = User::create(['ip' => $request->ip()]);
        }

        Auth::login($user);

        return $next($request);
    }
}