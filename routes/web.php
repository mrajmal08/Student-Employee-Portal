<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/students', [App\Http\Controllers\StudentController::class, 'index'])->name('students.index');
Route::get('/student/create', [App\Http\Controllers\StudentController::class, 'create'])->name('students.create');
Route::post('/student/insert', [App\Http\Controllers\StudentController::class, 'insert'])->name('students.insert');
Route::get('/student/view', [App\Http\Controllers\StudentController::class, 'view'])->name('students.view');
Route::get('/student/edit/{id}', [App\Http\Controllers\StudentController::class, 'edit'])->name('students.edit');
Route::post('/student/update/{id}', [App\Http\Controllers\StudentController::class, 'update'])->name('students.update');
Route::get('/student/delete/{id}', [App\Http\Controllers\StudentController::class, 'delete'])->name('students.delete');
