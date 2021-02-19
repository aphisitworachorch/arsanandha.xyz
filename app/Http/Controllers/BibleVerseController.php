<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class BibleVerseController extends Controller
{
    public static function bible(){
        return Http::get('https://beta.ourmanna.com/api/v1/get/?format=json')->json();
    }
}
