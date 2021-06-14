<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use Molayli\CloudflareRealIpServiceProvider;

class Logger
{
    private string $date;
    private string $random;

    public function __construct ()
    {
        $this->date = Carbon::now()->toDateString();
        $this->random = Str::random(16);
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $ip = $request->getClientIp ();
        $agent = new Agent();
        $body = array(
            "ip_address"=>$ip,
            "user_agent"=>$agent->getUserAgent ()
        );
        Redis::hSet("request_log:{$this->date}:{$this->random}",'ip_address_v4',(inet_pton($ip)),'ip_address_v6',($ip),'user_agent',$body['user_agent'],'request_body',json_encode($request->all()));
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
        Cache::increment('visit_today');
        CloudflareRealIpServiceProvider::ip ();
        Redis::hSet("visit_log:{$this->date}:{$this->random}",'ip_address_v4',(inet_pton($ip)),'ip_address_v6',($ip),'user_agent',$body['user_agent'],'header_http',json_encode($body['header']));
//        Cache::tags("visit_log_{$ip}")->put("visit_{$random}",json_encode($body),86400);
    }
}
