<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2/19/19
 * Time: 9:35 PM
 */

namespace App\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRules
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::user()->userRole->slug !== 'admin1') {
            return abort(401);
        }

        return $next($request);
    }

}
