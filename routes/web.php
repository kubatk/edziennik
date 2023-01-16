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
    return view('welcome');
});

Route::get('main', function (){return view('main');})->name('main');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Headmaster
Route::get('/add-user', function (){return view('headmaster.add_user');})->name('add_user');
Route::post('addUser', [App\Http\Controllers\HeadmasterController::class, 'addUser']);

Route::get('/manage-users', function (){return view('headmaster.manage_users');})->name('manage_users');

Route::get('/add-class', function (){return view('headmaster.add_class');})->name('add_class');
Route::post('addClass', [App\Http\Controllers\HeadmasterController::class, 'addClass']);

Route::get('/manage-classes', function (){return view('headmaster.manage_classes');})->name('manage_classes');

Route::get('/class/{class}', [App\Http\Controllers\HeadmasterController::class, 'viewTimetable'])->name('headmaster_timetable');

Route::get('/add-lesson', function (){return view('headmaster.add_lesson');})->name('add_lesson');
Route::post('addLesson', [App\Http\Controllers\HeadmasterController::class, 'addLesson']);

Route::post('addTimetable', [App\Http\Controllers\HeadmasterController::class, 'addToTimetable']);
Route::post('removeTimetable', [App\Http\Controllers\HeadmasterController::class, 'removeFromTimetable']);

// Teacher
Route::get('/marks', [\App\Http\Controllers\TeacherController::class, 'show_marks'])->name('teacher_marks');
Route::get('/marks/{class}', [\App\Http\Controllers\TeacherController::class, 'show_marks'])->name('teacher_marks_with_class');
Route::post('addMarkCategory', [App\Http\Controllers\TeacherController::class, 'addMarkCategory']);
Route::post('saveMarks', [App\Http\Controllers\TeacherController::class, 'saveMarks']);

// Student

// Parent
