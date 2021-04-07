<?php

namespace App\Http\Controllers;

use App\Models\MilitaryEnlist;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Illuminate\Http\JsonResponse;
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
        $practicePeriod = Carbon::create(Carbon::now()->toDateString())->addWeeks(13);

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

    /**
     *  API Usage
     *  ----- METHOD [POST] -----
     *  type -> [round_save is first round checking]
     *  type -> [note is note about military story]
     *  type -> [event is note about event and firing to LINE Notify]
     *  textNote -> [is content]
     *  dataType -> [default is ios_note or postman_note]
     *  valueJSON -> [array value]
     *  activeJSON -> [true is active / false is inactive]
     *  round -> [round note 1 is round 1 2 is round 2]
     *  @param Request $request
     *  @return JsonResponse
     */
    public function beaconForm(Request $request):JsonResponse
    {
        $round = array(
            1=>array(
                "start_month"=>[2021,5,1],
                "duration_month"=>6
            ),
            2=>array(
                "start_month"=>[2021,11,1],
                "duration_month"=>6
            )
        );
        if(array_key_exists(intval($request->round),$round)){
            if($request->type == "round_save"){
                $request->valueJSON = $round;
                $MIL = MilitaryEnlist::create(
                    array(
                        "type"=>$request->type,
                        "info"=>MilitaryEnlist::MILJSON($request)
                    )
                );
                if($MIL->military_id){
                    return response()->json(
                        array(
                            "status"=>"completed"
                        )
                    );
                }else{
                    return response()->json(
                        array(
                            "status"=>"fail"
                        )
                    );
                }
            }
        }else{
            if($request->type == "note"){
                $request->valueJSON = array(
                    "text"=>$request->textNote
                );
                $MIL = MilitaryEnlist::create(
                    array(
                        "type"=>$request->type,
                        "info"=>MilitaryEnlist::MILJSON($request)
                    )
                );
                if($MIL->military_id){
                    return response()->json(
                        array(
                            "status"=>"completed"
                        )
                    );
                }else{
                    return response()->json(
                        array(
                            "status"=>"fail"
                        )
                    );
                }
            }else if($request->type == "event"){
                $request->valueJSON = array(
                    "text"=>$request->textNote
                );
                $MIL = MilitaryEnlist::create(
                    array(
                        "type"=>$request->type,
                        "info"=>MilitaryEnlist::MILJSON($request)
                    )
                );
                if($MIL->military_id){
                    Line::send('จดหมายจากโต้ : '.$request->textNote);
                    return response()->json(
                        array(
                            "status"=>"completed"
                        )
                    );
                }else{
                    return response()->json(
                        array(
                            "status"=>"fail"
                        )
                    );
                }
            }

        }

    }
}
