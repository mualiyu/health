<?php

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

//user Route
Route::get('/user/all', [App\Http\Controllers\UserController::class, 'index']);
Route::get('/user/getById', [App\Http\Controllers\UserController::class, 'getById']);
Route::post('/user/create', [App\Http\Controllers\UserController::class, 'create']);
Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update']);
Route::post('/user/delete', [App\Http\Controllers\UserController::class, 'delete']);

//Device Route
Route::get('/device/all', [App\Http\Controllers\DeviceController::class, 'index']);
Route::get('/device/getById', [App\Http\Controllers\DeviceController::class, 'getById']);
Route::post('/device/create', [App\Http\Controllers\DeviceController::class, 'create']);
Route::post('/device/update', [App\Http\Controllers\DeviceController::class, 'update']);
Route::post('/device/delete', [App\Http\Controllers\DeviceController::class, 'delete']);


//Record Route
Route::get('/record/all', [App\Http\Controllers\RecordController::class, 'index']);
Route::get('/record/getById', [App\Http\Controllers\RecordController::class, 'getById']);
Route::post('/record/create', [App\Http\Controllers\RecordController::class, 'create']);
Route::post('/record/update', [App\Http\Controllers\RecordController::class, 'update']);
Route::post('/record/delete', [App\Http\Controllers\RecordController::class, 'delete']);

//Api Auth Route
Route::get('/apiUser/all', [App\Http\Controllers\ApiAuthController::class, 'index']);
Route::get('/apiUser/getByName', [App\Http\Controllers\ApiAuthController::class, 'getByName']);
Route::post('/apiUser/create', [App\Http\Controllers\ApiAuthController::class, 'create']);
// Route::post('/record/update', [App\Http\Controllers\RecordController::class, 'update']);
// Route::post('/record/delete', [App\Http\Controllers\RecordController::class, 'delete']);
