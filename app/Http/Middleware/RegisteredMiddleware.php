<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 9/27/2018
 * Time: 9:36 PM
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class RegisteredMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($user = auth()->user()) {
            $userData = $user->userData;

            if ($userData && $userData->completed == 1) {
                return $next($request);
            } else {
                return redirect(route('registeruser'));
            }
        }
        return redirect(route('login'));
    }
}
