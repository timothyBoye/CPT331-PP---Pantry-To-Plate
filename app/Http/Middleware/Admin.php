<?php

namespace App\Http\Middleware;

use App\UserRole;
use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
        $admin = UserRole::where('user_role_name', '=', 'Admin')->first();

        if ( Auth::check() && Auth::user()->user_role_id == $admin->id )
        {
            return $next($request);
        }

        return redirect('home');
    }
}
