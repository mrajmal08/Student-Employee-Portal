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

Auth::routes();

//Student routes
Route::get('/', [App\Http\Controllers\HomeController::class, 'home']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/students', [App\Http\Controllers\StudentController::class, 'index'])->name('students.index');
Route::get('/student/create/{id}', [App\Http\Controllers\StudentController::class, 'create'])->name('students.create');
Route::get('/student/add', [App\Http\Controllers\StudentController::class, 'add'])->name('students.add');
Route::post('/student/add_student', [App\Http\Controllers\StudentController::class, 'add_student'])->name('students.add_student');
Route::post('/student/update_student/{id}', [App\Http\Controllers\StudentController::class, 'update_student'])->name('students.update_student');
Route::post('/student/insert', [App\Http\Controllers\StudentController::class, 'insert'])->name('students.insert');
Route::get('/student/view/{id}', [App\Http\Controllers\StudentController::class, 'view'])->name('students.view');
Route::get('/student/edit/{id}', [App\Http\Controllers\StudentController::class, 'edit'])->name('students.edit');
Route::post('/student/update/{id}', [App\Http\Controllers\StudentController::class, 'update'])->name('students.update');
Route::get('/student/delete/{id}', [App\Http\Controllers\StudentController::class, 'delete'])->name('students.delete');
Route::get('/student/media/delete/{id}', [App\Http\Controllers\StudentController::class, 'mediaDelete'])->name('media.delete');

//Course routes
Route::get('/courses', [App\Http\Controllers\CourseController::class, 'index'])->name('courses.index');
Route::get('/course/create', [App\Http\Controllers\CourseController::class, 'create'])->name('courses.create');
Route::post('/course/insert', [App\Http\Controllers\CourseController::class, 'insert'])->name('courses.insert');
Route::get('/course/edit/{id}', [App\Http\Controllers\CourseController::class, 'edit'])->name('courses.edit');
Route::post('/course/update/{id}', [App\Http\Controllers\CourseController::class, 'update'])->name('courses.update');
Route::get('/course/delete/{id}', [App\Http\Controllers\CourseController::class, 'delete'])->name('courses.delete');

//Dependant routes
Route::get('/dependants', [App\Http\Controllers\DependantController::class, 'index'])->name('dependants.index');
Route::get('/dependant/create', [App\Http\Controllers\DependantController::class, 'create'])->name('dependants.create');
Route::post('/dependant/insert', [App\Http\Controllers\DependantController::class, 'insert'])->name('dependants.insert');
Route::get('/dependant/edit/{id}', [App\Http\Controllers\DependantController::class, 'edit'])->name('dependants.edit');
Route::post('/dependant/update/{id}', [App\Http\Controllers\DependantController::class, 'update'])->name('dependants.update');
Route::get('/dependant/delete/{id}', [App\Http\Controllers\DependantController::class, 'delete'])->name('dependants.delete');

//Recruitment Agent routes
Route::get('/recruitment/agents', [App\Http\Controllers\RecruitmentAgentController::class, 'index'])->name('recruitments.index');
Route::get('/recruitment/agent/create', [App\Http\Controllers\RecruitmentAgentController::class, 'create'])->name('recruitments.create');
Route::post('/recruitment/agent/insert', [App\Http\Controllers\RecruitmentAgentController::class, 'insert'])->name('recruitments.insert');
Route::get('/recruitment/agent/edit/{id}', [App\Http\Controllers\RecruitmentAgentController::class, 'edit'])->name('recruitments.edit');
Route::get('/recruitment/agent/view', [App\Http\Controllers\RecruitmentAgentController::class, 'view'])->name('recruitments.view');
Route::post('/recruitment/agent/update/{id}', [App\Http\Controllers\RecruitmentAgentController::class, 'update'])->name('recruitments.update');
Route::get('/recruitment/agent/delete/{id}', [App\Http\Controllers\RecruitmentAgentController::class, 'delete'])->name('recruitments.delete');
Route::post('/recruitment_agent/update', [App\Http\Controllers\RecruitmentAgentController::class, 'updateAgent'])->name('recruitments_agent.update');

//Pre Cas Application routes
Route::get('/pre/cas/application', [App\Http\Controllers\PreCasApplicationController::class, 'index'])->name('precas.index');
Route::get('/pre/cas/application/create', [App\Http\Controllers\PreCasApplicationController::class, 'create'])->name('precas.create');
Route::post('/pre/cas/application/insert', [App\Http\Controllers\PreCasApplicationController::class, 'insert'])->name('precas.insert');
Route::get('/pre/cas/application/edit/{id}', [App\Http\Controllers\PreCasApplicationController::class, 'edit'])->name('precas.edit');
Route::get('/pre/cas/application/view', [App\Http\Controllers\PreCasApplicationController::class, 'view'])->name('precas.view');
Route::post('/pre/cas/application/update/{id}', [App\Http\Controllers\PreCasApplicationController::class, 'update'])->name('precas.update');
Route::get('/pre/cas/application/delete/{id}', [App\Http\Controllers\PreCasApplicationController::class, 'delete'])->name('precas.delete');

//Post Cas Application routes
Route::get('/post/cas/application', [App\Http\Controllers\PostCasApplicationController::class, 'index'])->name('postcas.index');
Route::get('/post/cas/application/create', [App\Http\Controllers\PostCasApplicationController::class, 'create'])->name('postcas.create');
Route::post('/post/cas/application/insert', [App\Http\Controllers\PostCasApplicationController::class, 'insert'])->name('postcas.insert');
Route::get('/post/cas/application/edit/{id}', [App\Http\Controllers\PostCasApplicationController::class, 'edit'])->name('postcas.edit');
Route::post('/post/cas/application/update/{id}', [App\Http\Controllers\PostCasApplicationController::class, 'update'])->name('postcas.update');
Route::get('/post/cas/application/delete/{id}', [App\Http\Controllers\PostCasApplicationController::class, 'delete'])->name('postcas.delete');

//Users routes
Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
Route::get('/user/create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
Route::post('/user/insert', [App\Http\Controllers\UserController::class, 'insert'])->name('user.insert');
Route::get('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
Route::post('/user/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
Route::get('/user/delete/{id}', [App\Http\Controllers\UserController::class, 'delete'])->name('user.delete');

//Status routes
Route::get('/status', [App\Http\Controllers\StatusController::class, 'index'])->name('status.index');
Route::get('/status/create', [App\Http\Controllers\StatusController::class, 'create'])->name('status.create');
Route::post('/status/insert', [App\Http\Controllers\StatusController::class, 'insert'])->name('status.insert');
Route::get('/status/edit/{id}', [App\Http\Controllers\StatusController::class, 'edit'])->name('status.edit');
Route::post('/status/update/{id}', [App\Http\Controllers\StatusController::class, 'update'])->name('status.update');
Route::get('/status/delete/{id}', [App\Http\Controllers\StatusController::class, 'delete'])->name('status.delete');

//Tasks routes
Route::get('/task', [App\Http\Controllers\TaskController::class, 'index'])->name('task.index');
Route::get('/task/create', [App\Http\Controllers\TaskController::class, 'create'])->name('task.create');
Route::post('/task/insert', [App\Http\Controllers\TaskController::class, 'insert'])->name('task.insert');
Route::get('/task/edit/{id}', [App\Http\Controllers\TaskController::class, 'edit'])->name('task.edit');
Route::post('/task/update/{id}', [App\Http\Controllers\TaskController::class, 'update'])->name('task.update');
Route::get('/task/delete/{id}', [App\Http\Controllers\TaskController::class, 'delete'])->name('task.delete');
