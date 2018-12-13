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

        $user_token = $request->session()->get('user_token');

        $user = User::where('remember_token', $user_token)->first();

        if (!$user) {
            $user = User::where('id', DB::table('sessions')->where('ip_address', $request->ip())->value('user_id'))->first();

            if (!$user) {
                $user = User::create(['remember_token' => str_random(100)]);
                $user->roles()->attach(Role::where('role_name', 'user')->first());
            }
        }

        $request->session()->put('user_token', $user->remember_token);

        Auth::login($user);

        return $next($request);
    }
}
