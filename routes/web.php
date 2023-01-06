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
// Teacher

// Student

// Parent
