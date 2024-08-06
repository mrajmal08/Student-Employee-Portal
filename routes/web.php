<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

//Student routes
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/students', [App\Http\Controllers\StudentController::class, 'index'])->name('students.index');
Route::get('/student/create', [App\Http\Controllers\StudentController::class, 'create'])->name('students.create');
Route::post('/student/insert', [App\Http\Controllers\StudentController::class, 'insert'])->name('students.insert');
Route::get('/student/view', [App\Http\Controllers\StudentController::class, 'view'])->name('students.view');
Route::get('/student/edit/{id}', [App\Http\Controllers\StudentController::class, 'edit'])->name('students.edit');
Route::post('/student/update/{id}', [App\Http\Controllers\StudentController::class, 'update'])->name('students.update');
Route::get('/student/delete/{id}', [App\Http\Controllers\StudentController::class, 'delete'])->name('students.delete');

//Course routes
Route::get('/courses', [App\Http\Controllers\CourseController::class, 'index'])->name('courses.index');
Route::get('/course/create', [App\Http\Controllers\CourseController::class, 'create'])->name('courses.create');
Route::post('/course/insert', [App\Http\Controllers\CourseController::class, 'insert'])->name('courses.insert');
Route::get('/course/edit/{id}', [App\Http\Controllers\CourseController::class, 'edit'])->name('courses.edit');
Route::post('/course/update/{id}', [App\Http\Controllers\CourseController::class, 'update'])->name('courses.update');
Route::get('/course/delete/{id}', [App\Http\Controllers\CourseController::class, 'delete'])->name('courses.delete');
