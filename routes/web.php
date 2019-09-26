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

// DB::listen(function ($event) {
//     dump($event->sql);
// });

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/todolist/delete', 'TodolistController@delete')->name('todolist.delete');
Route::resource('/todolist', 'TodolistController');
Route::resource('/task', 'VueController');

Route::post('/vue', 'VueController@store');
Route::patch('/vue/{id}', 'VueController@update');
Route::delete('/vue/{id}', 'VueController@destroy');
