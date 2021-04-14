<?php

namespace App\Http\Controllers;

use App\Models\CovidToday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Phattarachai\LineNotify\Line;

class COVIDController extends Controller
{
    public static function covidHeartBeat()
    {
        try{
            $dataF = Http::retry(10,100)->get('https://covid19.th-stat.com/api/open/today')->json();
            if(!empty($dataF)){
                if($dataF['NewConfirmed'] != ""){
                    $lineNotify = new Line(env('LINE_NOTIFY_LOGGER_ACCESS_TOKEN'));
                    $lastData = CovidToday::orderByDesc('created_at')->orderByDesc('id')->get()->take(1);
                    foreach($lastData as $dt){
                        if($dt->today_covid > $dataF['NewConfirmed'] || $dt->today_covid < $dataF['NewConfirmed']){
                            $lineNotify->send("จำนวนผู้ป่วยโควิด : ".$dataF['NewConfirmed']);
                        }
                        if($dt->today_recovered > $dataF['NewRecovered'] || $dt->today_recovered < $dataF['NewRecovered']){
                            $lineNotify->send("หายป่วยแล้ว : ".$dataF['NewRecovered']);
                        }
                    }

                    $data = CovidToday::create(
                        array(
                            "total_covid"=>$dataF['Confirmed'],
                            "today_covid"=>$dataF['NewConfirmed'],
                            "total_recovered"=>$dataF['Recovered'],
                            "today_recovered"=>$dataF['NewRecovered']
                        )
                    );
                    if($data->id){
                        return response()->json(array(
                            "now"=>$dataF['NewConfirmed']
                        ));
                    }else{
                        return response()->json(array(
                            "now"=>'bad'
                        ));
                    }
                }
            }
        }catch(Exception $e){
            return $e;
        }
    }
}
