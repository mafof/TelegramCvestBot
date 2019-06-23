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

Auth::routes(['register' => false]);

Route::get('/', function() {return view('home'); })->name('home');

Route::resource('/quest', 'QuestStepConstructor')->except(['index', 'show']);

Route::get('/about', 'AboutServiceController@index')->name('about');


// Testing routes =>
Route::get('/rm/{user}', function ($user) {
    $users = app()->make('telegramStorage');
    dd($users->removeUser($user));
});

Route::get('/gt/{user}', function ($user) {
    $users = app()->make('telegramStorage');
    dd($users->getUser($user));
});