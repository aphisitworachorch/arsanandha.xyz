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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/',[LandingController::class,'index']);
Route::get('/about',[LandingController::class,'about']);
Route::get('/burden/insert',[LandingController::class,'burdenInsert']);
Route::get('/grad2020',[LandingController::class,'graduation']);
Route::get('/thankful',[ThankfulController::class,'index']);
Route::get('/thankful/card/{card_id?}',[ThankfulController::class,'person']);
Route::get('/api/thankful/card/{card_id?}',[ThankfulController::class,'viewByURLID']);
Route::post('/thankful',[ThankfulController::class,'thankful']);
Route::get('/extracurriculars/{activity?}',[LandingController::class,'extracurriculars']);
Route::get('/thankful/view',[ThankfulController::class,'search']);
Route::get('/thankful/view/ajax',[ThankfulController::class,'ajaxView']);
Route::post('/thankful/view/insert',[ThankfulController::class,'ajaxInsert']);
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
        Artisan::call('config:cache');
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
