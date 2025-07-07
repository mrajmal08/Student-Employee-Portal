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

    Route::get('/roles', [App\Http\Controllers\UserController::class, 'get_all_roles']);


    //Sessions routes
    Route::get('/sessions', [App\Http\Controllers\SessionController::class, 'index']);
    Route::post('/session/insert', [App\Http\Controllers\SessionController::class, 'insert']);
    Route::get('/session/single/{id}', [App\Http\Controllers\SessionController::class, 'single']);
    Route::post('/session/update', [App\Http\Controllers\SessionController::class, 'update']);
    Route::get('/session/delete/{id}', [App\Http\Controllers\SessionController::class, 'delete']);

    //Department routes
    Route::get('/departments', [App\Http\Controllers\DepartmentController::class, 'index']);
    Route::post('/department/insert', [App\Http\Controllers\DepartmentController::class, 'insert']);
    Route::get('/department/single/{id}', [App\Http\Controllers\DepartmentController::class, 'single']);
    Route::post('/department/update', [App\Http\Controllers\DepartmentController::class, 'update']);
    Route::get('/department/delete/{id}', [App\Http\Controllers\DepartmentController::class, 'delete']);

    //Designation routes
    Route::get('/designations', [App\Http\Controllers\DesignationController::class, 'index']);
    Route::post('/designation/insert', [App\Http\Controllers\DesignationController::class, 'insert']);
    Route::get('/designation/single/{id}', [App\Http\Controllers\DesignationController::class, 'single']);
    Route::post('/designation/update', [App\Http\Controllers\DesignationController::class, 'update']);
    Route::get('/designation/delete/{id}', [App\Http\Controllers\DesignationController::class, 'delete']);

    //Student routes
    Route::get('/students', [App\Http\Controllers\StudentController::class, 'index']);
    Route::post('/student/insert', [App\Http\Controllers\StudentController::class, 'insert']);
    Route::get('/student/single/{id}', [App\Http\Controllers\StudentController::class, 'single']);
    Route::post('/student/update', [App\Http\Controllers\StudentController::class, 'update']);
    Route::get('/student/delete/{id}', [App\Http\Controllers\StudentController::class, 'delete']);
    // Route::get('/student/create/{id}', [App\Http\Controllers\StudentController::class, 'create']);
    // Route::get('/student/add', [App\Http\Controllers\StudentController::class, 'add']);
    // Route::post('/student/insert', [App\Http\Controllers\StudentController::class, 'insert']);
    // Route::get('/student/edit/{id}', [App\Http\Controllers\StudentController::class, 'edit']);
    // Route::post('/student/update/{id}', [App\Http\Controllers\StudentController::class, 'update']);
    // Route::get('/student/media/delete/{id}', [App\Http\Controllers\StudentController::class, 'mediaDelete']);


    //Student Case routes
    Route::get('/case/get', [App\Http\Controllers\StudentCasesController::class, 'index']);
    Route::post('/case/insert', [App\Http\Controllers\StudentCasesController::class, 'insert']);
    Route::get('/case/single/{id}', [App\Http\Controllers\StudentCasesController::class, 'single']);
    Route::get('/case/update', [App\Http\Controllers\StudentCasesController::class, 'update']);

    //Interview routes
    Route::get('/interview', [App\Http\Controllers\InterviewController::class, 'index']);
    Route::post('/interview/insert', [App\Http\Controllers\InterviewController::class, 'insert']);
    Route::post('/interview/update', [App\Http\Controllers\InterviewController::class, 'update']);
    Route::post('/interview/delete/{id}', [App\Http\Controllers\InterviewController::class, 'delete']);

    Route::get('/document/categories', [App\Http\Controllers\StudentCasesController::class, 'get_media_categories']);
    Route::get('/case/media', [App\Http\Controllers\StudentCasesController::class, 'case_media']);
    Route::post('/add/media', [App\Http\Controllers\StudentCasesController::class, 'add_media']);

    //Finance routes
    Route::post('/finance/insert', [App\Http\Controllers\FinanceController::class, 'insert']);


});
