<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class AssignGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;
        echo '1';
        foreach ($guards as $guard) {
            if (!Auth::guard($guard)->check()) {
                if ($guard == 'admin') {
                    return \redirect()->route('admin.login');
                } else {
                    return redirect('login');
                }
            }
        }

        Auth::shouldUse($guard);

        return $next($request);
    }
}
