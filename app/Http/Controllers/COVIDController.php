<?php

namespace App\Http\Controllers;

use App\Models\CovidToday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Phattarachai\LineNotify\Line;

class COVIDController extends Controller
{
    public static function covidHeartBeat(){
        $data = Http::get('https://covid19.th-stat.com/api/open/today')->json();
        $lineNotify = new Line(env('LINE_NOTIFY_LOGGER_ACCESS_TOKEN'));
        $lineNotify->send("ผู้ป่วยโควิด ณ ตอนนี้ " . $data['NewConfirmed']);
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