<?php

use App\Events\SendMessage;
use App\Http\Controllers\Cach;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
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

//Broadcast::routes(['middleware' => ['auth:sanctum']]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});





Route::middleware('auth:sanctum')->post('/send' , function(Request $request){
    
     event(new SendMessage($request->input('message') , auth()->user()) );
     return true ; 
});



Route::post('/register', [Controller::class,'register']);
Route::post('/login', [Controller::class,'login']);
Route::get('/cach' , [Cach::class , 'test']);