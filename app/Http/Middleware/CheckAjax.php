<?php

namespace App\Http\Middleware;
use Request;
use Closure;

class checkAjax {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next) {

        if (!Request::ajax()) {
            abort(403);
        }

        return $next($request);
    }
}