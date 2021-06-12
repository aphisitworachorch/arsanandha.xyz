<?php

namespace App\Http\Controllers;

use App\Models\JobHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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
//            ->term(BibleVerseController::bible()['verse']['details']['text'])
            ->term("jesus christ cross bible")
            ->count(1)
            ->toJson();
        $agent = new Agent();
        print_r(BibleVerseController::abbreviate (BibleVerseController::bible()['verse']['details']['reference']));
        if($agent->isMobile() || $agent->isTablet() || $agent->isGenericPhone() || $agent->isGenericTablet()){
            return Inertia::render('Index/IndexTMobile',[
                'verse'=>BibleVerseController::bible()['verse']['details']['text'],
                'references'=>BibleVerseController::bible()['verse']['details']['reference'],
                'photoLink'=>$photo[0]->urls->regular,
                'infoUnsplash'=>$photo[0]->user->name,
                'infoUnsplashUsername'=>$photo[0]->user->username,
            ]);
        }else{
            return Inertia::render('Index/IndexT',[
                'verse'=>BibleVerseController::bible()['verse']['details']['text'],
                'references'=>BibleVerseController::bible()['verse']['details']['reference'],
                'photoLink'=>$photo[0]->urls->regular,
                'infoUnsplash'=>$photo[0]->user->name,
                'infoUnsplashUsername'=>$photo[0]->user->username,
            ]);
        }

    }

    public function about():\Inertia\Response
    {
        $job = JobHistory::query ()->orderBy('end')->get();
        return Inertia::render('arsanandha/About',[
            'jobDetails'=>$job
        ]);
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

    public function logUser(Request $request){

    }
}
