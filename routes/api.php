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
//put api for  update user
Route::put('user-update/{id}',[RestApiController::class,'user_update']);
//patch api for  update single record
Route::patch('single-update/{id}',[RestApiController::class,'single_update']);
// api for delete single user
Route::delete('single-delete/{id}',[RestApiController::class,'single_delete']);
// api for delete user with json
Route::delete('json-delete',[RestApiController::class,'json_delete']);
// api for delete multiple user
Route::delete('multiple-delete/{ids}',[RestApiController::class,'multiple_delete']);
// api for delete multiple user with json
Route::delete('multiple-delete-json',[RestApiController::class,'multiple_delete_json']);