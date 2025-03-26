<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


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

Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/courses', [App\Http\Controllers\CourseController::class, 'index']);
    Route::post('/course/insert', [App\Http\Controllers\CourseController::class, 'insert']);
    Route::get('/course/single/{id}', [App\Http\Controllers\CourseController::class, 'single']);
    Route::post('/course/update', [App\Http\Controllers\CourseController::class, 'update']);
    Route::get('/course/delete/{id}', [App\Http\Controllers\CourseController::class, 'delete']);
});
