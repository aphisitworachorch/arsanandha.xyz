<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;

class LandingController extends Controller
{
    public function index(){
        return Inertia::render('Index/IndexT',[
            'verse'=>BibleVerseController::bible()['verse']['details']['text'],
            'ref'=>BibleVerseController::bible()['verse']['details']['reference']
        ]);
    }

    public function about(){
        return Inertia::render('arsanandha/About');
    }

    public function burdenInsert(){
        return Inertia::render('arsanandha/bizpotential/BurdenReport');
    }

    public function graduation(){
        return Inertia::render('arsanandha/invitation/Invite');
    }

    public function extracurriculars(Request $request){
        if($request->activity == "sutsapa"){
            return Inertia::render('arsanandha/profile/StudentCouncil');
        }else if($request->activity == "katakorn"){
            return Inertia::render('arsanandha/profile/Katakorn');
        }else if($request->activity == "sippanondha"){
            return Inertia::render('arsanandha/profile/Sippanondha');
        }else if($request->activity == "it"){
            return Inertia::render('arsanandha/profile/IT20');
        }else if($request->activity == "s7"){
            return Inertia::render('arsanandha/profile/Suranivet7');
        }else if($request->activity == null){
            return Inertia::render('arsanandha/profile/MainExtra');
        }
    }
}
