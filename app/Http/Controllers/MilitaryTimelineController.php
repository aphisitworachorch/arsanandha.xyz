<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\ArrayShape;
use MarkSitko\LaravelUnsplash\UnsplashFacade;
use Phattarachai\LineNotify\Facade\Line;

class MilitaryTimelineController extends Controller
{
    /** DOCS https://dev.classmethod.jp/articles/changetime-with-helpers/
     * @param $arg
     * @return string
     */
    public static function simpleDateFormat($arg):string
    {
        $thai_months = [
            1 => 'ม.ค.',
            2 => 'ก.พ.',
            3 => 'มี.ค.',
            4 => 'เม.ย.',
            5 => 'พ.ค.',
            6 => 'มิ.ย.',
            7 => 'ก.ค.',
            8 => 'ส.ค.',
            9 => 'ก.ย.',
            10 => 'ต.ค.',
            11 => 'พ.ย.',
            12 => 'ธ.ค.',
        ];
        $date = Carbon::parse($arg);
        $month = $thai_months[$date->month];
        $year = $date->year + 543;
        return $date->format("j $month $year");
    }

    public function generateTimePacker(Request $request):bool
    {
        $start = Carbon::create(2021,5,1);
        $end = Carbon::create(2021,5,1)->addMonths(6);
        $practicePeriod = Carbon::create(2021,5,1)->addWeeks(10);

        $period = [];
        $time = CarbonPeriod::create($start,$end);
        $timePracticePeriod = CarbonPeriod::create($start,$practicePeriod)->toArray();
        foreach($time as $key => $t){
            if(in_array($t,$timePracticePeriod)){
                $period["practice"][] = self::simpleDateFormat($t);
            }else{
                $period["watchdog_period"][] = self::simpleDateFormat($t);
            }
        }
        $remainDay = Carbon::now()->diffInDays($start,false);
        $remainPracticeMonths = $start->diffInMonths($practicePeriod);

        if($request->action == "line_notify"){
            $photo = UnsplashFacade::randomPhoto()
                ->orientation('landscape')
                ->term("remaining ".$remainDay." days")
                ->count(1)
                ->toJson();
            /** DOCS https://phattarachai.dev/line-notify-laravel-php */
            Line::send('ช่วงเวลาการเข้ารับราชการทหารของโต้ ตั้งแต่วันที่ '.self::simpleDateFormat($start).' ถึง '.self::simpleDateFormat($end));
            Line::send('ช่วงเวลาการฝึกทหารของโต้ ตั้งแต่วันที่ '.self::simpleDateFormat($start).' ถึง '.self::simpleDateFormat($practicePeriod). ' ซึ่งเป็นระยะเวลา '.$remainPracticeMonths. ' เดือน');
            Line::imageUrl($photo[0]->urls->regular)
            ->send('เหลืออีก '.$remainDay.' วัน สำหรับการเข้ารับราชการทหาร ของโต้');
        }

        return true;
    }

    /** PHP 8 Function */
    #[ArrayShape(["remainPracticeMonths" => "float|int|string", "remainDay" => "int"])]
    public function getRemainingTime():array
    {
        $start = Carbon::create(2021,5,1);
        $end = Carbon::create(2021,5,1)->addMonths(6);
        $practicePeriod = Carbon::create(Carbon::now()->toDateString())->addWeeks(10);

        $remainDay = Carbon::now()->diffInDays($start,false);

        if(Carbon::today()->lessThan($start)){
            $remainPracticeMonths = "NOT_IN_TIME";
        }else{
            $remainPracticeMonths = $start->diffInDays($practicePeriod);
        }

        return array(
            "remainPracticeMonths"=>$remainPracticeMonths,
            "remainDay"=>$remainDay
        );
    }
}
