<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckVip

{

    public function handle($request, Closure $next)

    {

        if (Auth::user() && Auth::user()->vip === 1) {

            return $next($request);

        }



        abort(403, 'Vous n\'avez pas le rang nécessaire pour voir cette page !');

    }

}