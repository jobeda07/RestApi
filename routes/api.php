<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//get api for fatch user
Route::get('usershow/{id?}',[RestApiController::class,'usershow']);
//post api for add user
Route::post('user-add',[RestApiController::class,'user_add']);
//post api for add multiple user
Route::post('multiple-user-add',[RestApiController::class,'multiple_user_add']);