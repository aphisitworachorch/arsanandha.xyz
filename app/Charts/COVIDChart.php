<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\CovidToday;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class COVIDChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $dataChart = array("labels"=>array(),"dataset_1"=>array());
        $dataCovid = DB::table('covid_today')
            ->select(DB::raw('DISTINCT today_covid,DATE(created_at) as created_at'))
                ->orderBy(DB::raw('DATE(created_at)'),'ASC')
                ->get();
        foreach($dataCovid as $dc){
            array_push($dataChart['labels'],$dc->created_at);
            array_push($dataChart['dataset_1'],$dc->today_covid);
        }
        return Chartisan::build()
            ->labels($dataChart['labels'])
            ->dataset('Today Covid', $dataChart['dataset_1']);
    }
}
