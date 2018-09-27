<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 9/27/2018
 * Time: 9:31 PM
 */

namespace App\Http\Middleware;

use Closure;

class Secure
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $response->header('X-Frame-Options', 'ALLOW FROM');
        $response->header('Strict-Transport-Security', 'max-age=31536000');
        $response->header('X-XSS-Protection', '1');
        $response->header('X-Content-Type-Options', 'nosniff');
        $response->header('Content-Security-Policy', 'script-src \'self\' \'unsafe-inline\'');
        $response->header('X-Permitted-Cross-Domain-Policies', 'none');
        return $response;
    }
}
