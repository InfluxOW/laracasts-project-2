<?php

use Illuminate\Support\Facades\Auth;
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
})->name('main');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::resource('projects', 'ProjectsController');
    Route::resource('projects.tasks', 'ProjectTasksController');
    Route::get('/home', 'HomeController@index')->name('home');
});

Route::get('/home', 'HomeController@index')->name('home');
