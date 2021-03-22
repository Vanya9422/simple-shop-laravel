<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {

                switch (Auth::user()->role_name) {
                    case 'admin':
                        return redirect(route('admin.dashboard'));
                        break;
                    case 'seller':
                        return redirect(route('seller.dashboard'));
                        break;
                    case 'customer':
                        return redirect(route('customer.dashboard'));
                        break;

                    default:
                        return redirect('/');
                        break;
                }
            }
        }

        return $next($request);
    }
}
