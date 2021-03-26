<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class ComfortableController extends Controller
{

    /**
     * @var DateTimeZone
     */
    private $timezone;

    public function __construct()
    {
        $this->timezone = new DateTimeZone('Asia/Bangkok');
    }

    public function getWeather(){
        return Cache::remember('users', 3600, function () {
            $data = Http::get('https://api.darksky.net/forecast/e06679daf540e2d7c902fe206427acbb/14.9507091,102.0397285?units=si')->json();
            return $data;
        });
    }

    public function getCurrently(){
        $calculated = [];
        $epoch = $this->getWeather()['currently']['time'];
        $calculated['time'] = (new DateTime("@$epoch"))->setTimeZone($this->timezone)->format('Y-m-d H:i:s');
        $calculated['temperature'] = array(
            "actual_temp"=>$this->getWeather()['currently']['temperature'],
            "feel_like_temp"=>$this->getWeather()['currently']['apparentTemperature']
        );
        $calculated['humidity'] = (doubleval($this->getWeather()['currently']['humidity'])) * 100;
        $calculated['uv'] = (doubleval($this->getWeather()['currently']['uvIndex']));
        return $calculated;
    }

    public function getHourly(){
        $calculated = [];
        foreach($this->getWeather()['hourly']['data'] as $key => $curr){
            $epoch = $curr['time'];
            $calculated[$key]['time'] = (new DateTime("@$epoch"))->setTimeZone($this->timezone)->format('Y-m-d H:i:s');
            $calculated[$key]['temperature'] = array(
                "actual_temp"=>$curr['temperature'],
                "feel_like_temp"=>$curr['apparentTemperature']
            );
            $calculated[$key]['humidity'] = (doubleval($curr['humidity'])) * 100;
            $calculated[$key]['uv'] = (doubleval($curr['uvIndex']));
        }
        return $calculated;
    }

    public function getDaily(){
        $calculated = [];
        foreach($this->getWeather()['daily']['data'] as $key => $curr){
            $epoch = $curr['time'];
            $calculated[$key]['time'] = (new DateTime("@$epoch"))->setTimeZone($this->timezone)->format('Y-m-d H:i:s');
            $epochHigh = $curr['temperatureHighTime'];
            $epochLow = $curr['temperatureLowTime'];
            $calculated[$key]['temperatureActual'] = array(
                "high"=>$curr['temperatureHigh'],
                "high_at"=>(new DateTime("@$epochHigh"))->format('Y-m-d H:i:s'),
                "low"=>$curr['temperatureLow'],
                "low_at"=>(new DateTime("@$epochLow"))->format('Y-m-d H:i:s')
            );
            $epochFeelLikeHigh = $curr['apparentTemperatureHighTime'];
            $epochFeelLikeLow = $curr['apparentTemperatureLowTime'];
            $calculated[$key]['temperatureFeelLike'] = array(
                "high"=>$curr['apparentTemperatureHigh'],
                "high_at"=>(new DateTime("@$epochFeelLikeHigh"))->format('Y-m-d H:i:s'),
                "low"=>$curr['apparentTemperatureLow'],
                "low_at"=>(new DateTime("@$epochFeelLikeLow"))->format('Y-m-d H:i:s')
            );
            $calculated[$key]['humidity'] = (doubleval($curr['humidity'])) * 100;
            $epochUV = $curr['uvIndexTime'];
            $calculated[$key]['uv'] = array(
                "uv"=>(doubleval($curr['uvIndex'])),
                "uvTime"=>(new DateTime("@$epochUV"))->format('Y-m-d H:i:s')
            );
        }
        return $calculated;
    }

    public function getWeatherByConditions(Request $request){
        if($request->conditions == "current"){
            return $this->getCurrently();
        }else if($request->conditions == "hourly"){
            return $this->getHourly();
        }else if($request->conditions == "daily"){
            return $this->getDaily();
        }
    }
}
