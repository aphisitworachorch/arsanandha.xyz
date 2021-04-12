<?php

namespace App\Http\Controllers;

use App\Models\CovidToday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Phattarachai\LineNotify\Line;

class COVIDController extends Controller
{
    public static function covidHeartBeat():bool
    {
        $data = Http::get('https://covid19.th-stat.com/api/open/today')->json();
        $lineNotify = new Line(env('LINE_NOTIFY_LOGGER_ACCESS_TOKEN'));
        $lastData = CovidToday::latest("today_covid","today_recovered")->first();
        if($lastData->today_covid > $data['NewConfirmed'] || $lastData->today_covid < $data['NewConfirmed']){
            $lineNotify->send("จำนวนผู้ป่วยโควิด : ".$data['NewConfirmed']);
        }
        if($lastData->today_recovered > $data['NewRecovered'] || $lastData->today_recovered < $data['NewRecovered']){
            $lineNotify->send("หายป่วยแล้ว : ".$data['NewRecovered']);
        }

        $data = CovidToday::create(
            array(
                "total_covid"=>$data['Confirmed'],
                "today_covid"=>$data['NewConfirmed'],
                "total_recovered"=>$data['Recovered'],
                "today_recovered"=>$data['NewRecovered']
            )
        );
        if($data->id){
            return true;
        }else{
            return false;
        }
    }
}
