<?php

use App\Mail\orderDetails;
use App\Mail\SendMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirebaseController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/test',[FirebaseController::class, 'index'])->name('test.res');
Route::post('/search',[FirebaseController::class, 'search'])->name('search.res');



Route::post('/sendOrderDetails', function (Request $request) {
//
//    $input=$request->all();
//
//    dd($input['author']['firstName'].' '.$input['author']['lastName']);


             $mail= Mail::to('ec.ioptime@gmail.com')->send(new orderDetails($request->all()));
             dd($mail);

});

