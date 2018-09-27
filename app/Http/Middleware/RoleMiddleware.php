<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 9/27/2018
 * Time: 9:32 PM
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (Auth::guest()) {
            return redirect('login');
        }
        if (! $request->user()->hasRole($role)) {
            abort(403);
        }
        return $next($request);
    }
}
