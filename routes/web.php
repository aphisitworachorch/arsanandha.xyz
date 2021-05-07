<?php

use App\Http\Controllers\LandingController;
use App\Http\Controllers\ThankfulController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[LandingController::class,'index']);
Route::get('/about',[LandingController::class,'about']);
Route::get('/burden/insert',[LandingController::class,'burdenInsert']);
Route::get('/grad2020',[LandingController::class,'graduation']);
Route::group(['prefix'=>'thankful','as'=>'thankful.'],function(){
    Route::get('/',[ThankfulController::class,'index']);
    Route::post('/',[ThankfulController::class,'thankful']);
    Route::get('/card/{card_id?}',[ThankfulController::class,'person']);
    Route::get('/view',[ThankfulController::class,'search']);
    Route::get('/view/ajax',[ThankfulController::class,'ajaxView']);
    Route::post('/view/insert',[ThankfulController::class,'ajaxInsert']);
});
Route::get('/extracurriculars/{activity?}',[LandingController::class,'extracurriculars']);
Route::post('/updateURL', function() {
    if(Auth::check()){
        $msg = Artisan::call('arsanandha:genurlid');
        return response()->json(array(
            "message"=>Artisan::output(),
            "status"=>"OK"
        ));
    }
});
Route::get('/clear-cache', function() {
    if(Auth::check()){
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        return response()->json(array(
           "status"=>"cache_cleared",
           "debug"=>Artisan::output()
        ));
    }
});
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');
