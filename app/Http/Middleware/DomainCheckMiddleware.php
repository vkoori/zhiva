<?php

namespace App\Http\Middleware;

use Closure;

class DomainCheckMiddleware
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
        $allowedHosts = explode(',', env('ALLOWED_DOMAINS'));

        $requestHost = parse_url($request->headers->get('origin'),  PHP_URL_HOST);

        if(!app()->runningUnitTests()) {
            if(!\in_array($requestHost, $allowedHosts, false)) {
                $requestInfo = [
                    'host' => $requestHost,
                    'ip' => $request->getClientIp(),
                    'url' => $request->getRequestUri(),
                    'agent' => $request->header('User-Agent'),
                ];
                event($this->UnauthorizedAccess($requestInfo));

                abort(403, 'This host is not allowed');
                // throw new \SuspiciousOperationException('This host is not allowed');
            }
        }

        return $next($request);
    }

    public function UnauthorizedAccess($event)
    {
        \Log::warning('access_from_unauthorized_domain_ ' . date('Y-m-d_H:i:s'), $event);
    
    }

}