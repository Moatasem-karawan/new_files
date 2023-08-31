<?php


use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\Get_r_dataController ;

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
Route::middleware(["only_post_request"])->group(function (){
    Route::any("/get-by/id-number",[Get_r_dataController::class,"get_by_id_number"]);


});



Route::middleware(["only_post_request"])->group(function (){
    Route::any("/get-by/full-name",[Get_r_dataController::class,"get_by_full_name"]);


});
