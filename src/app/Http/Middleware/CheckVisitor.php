<?php

namespace App\Http\Middleware;

use App\User;
use App\Role;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        $user = User::where('id', DB::table('sessions')->where('ip_address', $request->ip())->value('user_id'))->first();

        if (!$user) {
            $user = User::create();
            $user->roles()->attach(Role::where('role_name', 'user')->first());
        }

        Auth::login($user, true);

        return $next($request);
    }
}
