<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
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
        Cache::increment('visit_today');
        Redis::command("HMSET visit_log_{$ip} ip_address '{$ip}' user_agent '{$body['user_agent']}' header_http '{$body['header']}'");
//        Cache::tags("visit_log_{$ip}")->put("visit_{$random}",json_encode($body),86400);
    }
}
