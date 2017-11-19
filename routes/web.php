<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('todo', 'TodoController@index')->name('todo.index'); // index page. call todo/{date}
Route::get('todo/{date}', 'TodoController@showByDate')->name('todo.showByDate');; // started_at, ended_at, options
Route::post('todo', 'TodoController@store')->name('todo.store');

Route::get('categories', 'TodoController@categories')->name('todo.categories');

Route::match(['PUT', 'PATCH'], 'todo', 'TodoController@update')->name('todo.update');

// user profile
Route::get('users/profile', 'UserController@profile')->name('users.profile');
Route::get('users/{user}', 'UserController@show')->name('users.show');
Route::get('users/achievements', 'UserController@achievements')->name('users.achievements');

// chart
Route::get('users/chart', 'UserController@chart')->name('users.chart');

