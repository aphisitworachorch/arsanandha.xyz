<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;

class Logger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
    public function terminate($request)
    {
        $ip = $request->getClientIp ();
        $agent = new Agent();
        $body = array(
            "ip_address"=>$ip,
            "user_agent"=>$agent->getUserAgent (),
            "header"=>$agent->getHttpHeaders ()
        );
        $random = Str::random(9);
        Cache::put("visit_log_{$ip}_{$random}",json_encode($body),86400);
    }
}
