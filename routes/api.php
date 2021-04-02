<?php

use App\Http\Controllers\ComfortableController;
use App\Http\Controllers\MilitaryTimelineController;
use App\Http\Controllers\ThankfulController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/spotifyRec',[ThankfulController::class,'spotifyRecommend']);
Route::get('/testPersona',[ThankfulController::class,'test_personalization']);
Route::get('/weather/{conditions}',[ComfortableController::class,'getWeatherByConditions']);
Route::get('/military/timepack',[MilitaryTimelineController::class,'generateTimePacker']);
Route::get('/randPhoto',function(){
    return Unsplash::randomPhoto()
        ->orientation('landscape')
        ->term('songkran')
        ->count(1)
        ->toJson();
});
