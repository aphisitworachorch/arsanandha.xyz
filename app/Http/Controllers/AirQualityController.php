<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;


class AirQualityController extends Controller
{
    public function air4Thai(Request $request){
        return $this->storeRedis(Http::get('air4thai.pcd.go.th/services/getNewAQI_JSON.php?stationID=47t')->json());
    }

    public function storeRedis($body){
        return Redis::set('air4thai_today',$body);
    }
}
