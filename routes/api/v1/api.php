<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get("/",[\App\Http\Controllers\Api\V1\Client\HomeController::class,"index"]);

Route::apiResource("/course",\App\Http\Controllers\Api\V1\Admin\CourseController::class);

Route::apiResource("/lesson",\App\Http\Controllers\Api\V1\Admin\LessonController::class);
