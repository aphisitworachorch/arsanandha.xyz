<?php

namespace App\Http\Controllers;

use App\Models\CovidToday;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Phattarachai\LineNotify\Line;

class COVIDController extends Controller
{
    public function covidAPICall ()
    {
        $covidHttp = Http::retry (10, 100)->get ('https://covid19.th-stat.com/json/covid19v2/getTodayCases.json')->json ();
        if (!empty($covidHttp)) {
            if ($covidHttp['NewConfirmed'] != "") {
                $data = CovidToday::create (
                    array (
                        "total_covid" => $covidHttp['Confirmed'],
                        "today_covid" => $covidHttp['NewConfirmed'],
                        "total_recovered" => $covidHttp['Recovered'],
                        "today_recovered" => $covidHttp['NewRecovered']
                    )
                );
                if ($data->id) {
                    return $covidHttp;
                } else {
                    return false;
                }
            }
        }
        return false;
    }

    public function covidHeartBeat()
    {
        try{
            $dataF = $this->covidAPICall ();
            if(!empty($dataF)){
                if($dataF['NewConfirmed'] != ""){
                    $lineNotify = new Line(env('LINE_NOTIFY_LOGGER_ACCESS_TOKEN'));
                    $lastData = CovidToday::orderByDesc('id')->get()->take(1);
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
