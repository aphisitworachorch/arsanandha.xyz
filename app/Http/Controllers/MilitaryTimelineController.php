<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Phattarachai\LineNotify\Facade\Line;

class MilitaryTimelineController extends Controller
{
    /** DOCS https://dev.classmethod.jp/articles/changetime-with-helpers/ */
    public static function simpleDateFormat($arg)
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

    public function generateTimePacker(){
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

        /** DOCS https://phattarachai.dev/line-notify-laravel-php */
        Line::send('เหลืออีก '.$remainDay.' วัน สำหรับการเข้ารับราชการทหาร ของโต้');
        Line::send('ช่วงเวลาการเข้ารับราชการทหารของโต้ ตั้งแต่วันที่ '.self::simpleDateFormat($start).' ถึง '.self::simpleDateFormat($end));
        Line::send('ช่วงเวลาการฝึกทหารของโต้ ตั้งแต่วันที่ '.self::simpleDateFormat($start).' ถึง '.self::simpleDateFormat($practicePeriod). ' ซึ่งเป็นระยะเวลา '.$remainPracticeMonths. ' เดือน');
        return $period;
    }
}
