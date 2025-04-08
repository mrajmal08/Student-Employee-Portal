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

     //Course routes
    Route::get('/courses', [App\Http\Controllers\CourseController::class, 'index']);
    Route::post('/course/insert', [App\Http\Controllers\CourseController::class, 'insert']);
    Route::get('/course/single/{id}', [App\Http\Controllers\CourseController::class, 'single']);
    Route::post('/course/update', [App\Http\Controllers\CourseController::class, 'update']);
    Route::get('/course/delete/{id}', [App\Http\Controllers\CourseController::class, 'delete']);

    //Status routes
    Route::get('/status', [App\Http\Controllers\StatusController::class, 'index']);
    Route::post('/status/insert', [App\Http\Controllers\StatusController::class, 'insert']);
    Route::get('/status/single/{id}', [App\Http\Controllers\StatusController::class, 'single']);
    Route::post('/status/update', [App\Http\Controllers\StatusController::class, 'update']);
    Route::get('/status/delete/{id}', [App\Http\Controllers\StatusController::class, 'delete']);

    //Users routes
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index']);
    Route::post('/user/insert', [App\Http\Controllers\UserController::class, 'insert']);
    Route::get('/user/single/{id}', [App\Http\Controllers\UserController::class, 'single']);
    Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update']);
    Route::get('/user/delete/{id}', [App\Http\Controllers\UserController::class, 'delete']);

    Route::get('/students', [App\Http\Controllers\StudentController::class, 'index']);
    Route::post('/student/add_student', [App\Http\Controllers\StudentController::class, 'add_student']);
    Route::get('/student/create/{id}', [App\Http\Controllers\StudentController::class, 'create']);
    Route::get('/student/add', [App\Http\Controllers\StudentController::class, 'add']);
    Route::post('/student/update_student/', [App\Http\Controllers\StudentController::class, 'update_student']);
    Route::post('/student/insert', [App\Http\Controllers\StudentController::class, 'insert']);
    Route::get('/student/single/{id}', [App\Http\Controllers\StudentController::class, 'single']);
    Route::get('/student/edit/{id}', [App\Http\Controllers\StudentController::class, 'edit']);
    Route::post('/student/update/{id}', [App\Http\Controllers\StudentController::class, 'update']);
    Route::get('/student/delete/{id}', [App\Http\Controllers\StudentController::class, 'delete']);
    Route::get('/student/media/delete/{id}', [App\Http\Controllers\StudentController::class, 'mediaDelete']);

});
