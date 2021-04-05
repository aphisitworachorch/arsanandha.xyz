<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;
use Jenssegers\Agent\Agent;
use MarkSitko\LaravelUnsplash\UnsplashFacade;

class LandingController extends Controller
{
    public function index():\Inertia\Response
    {
        $photo = UnsplashFacade::randomPhoto()
            ->orientation('landscape')
            ->term(BibleVerseController::bible()['verse']['details']['text'])
            ->count(1)
            ->toJson();

        $timeLeft = new MilitaryTimelineController();
        $at = $timeLeft->getRemainingTime();
        $agent = new Agent();
        if($agent->isMobile() || $agent->isTablet() || $agent->isGenericPhone() || $agent->isGenericTablet()){
            return Inertia::render('Index/IndexTMobile',[
                'verse'=>BibleVerseController::bible()['verse']['details']['text'],
                'references'=>BibleVerseController::bible()['verse']['details']['reference'],
                'photoLink'=>$photo[0]->urls->regular,
                'infoUnsplash'=>$photo[0]->user->name,
                'infoUnsplashUsername'=>$photo[0]->user->username,
                'remainDay'=>$at['remainDay'],
                'remainPractices'=>$at['remainPracticeMonths']
            ]);
        }else{
            return Inertia::render('Index/IndexT',[
                'verse'=>BibleVerseController::bible()['verse']['details']['text'],
                'references'=>BibleVerseController::bible()['verse']['details']['reference'],
                'photoLink'=>$photo[0]->urls->regular,
                'infoUnsplash'=>$photo[0]->user->name,
                'infoUnsplashUsername'=>$photo[0]->user->username,
                'remainDay'=>$at['remainDay'],
                'remainPractices'=>$at['remainPracticeMonths']
            ]);
        }

    }

    public function about():\Inertia\Response
    {
        return Inertia::render('arsanandha/About');
    }

    public function burdenInsert():\Inertia\Response
    {
        return Inertia::render('arsanandha/bizpotential/BurdenReport');
    }

    public function graduation():\Inertia\Response
    {
        return Inertia::render('arsanandha/invitation/Invite');
    }

    public function extracurriculars(Request $request):\Inertia\Response
    {
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
