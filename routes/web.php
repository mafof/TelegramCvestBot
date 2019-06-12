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

Route::get('/about', 'AboutServiceController@index')->name('about');

Route::get('/quest/create/node', function() {
    return view('quests.createNode', ["title" => "Конструктор квестов"]);
})->name('createQuest');


// Testing routes =>
Route::get('/rm/{user}', function ($user) {
    $users = app()->make('telegramStorage');
    dd($users->removeUser($user));
});

Route::get('/gt/{user}', function ($user) {
    $users = app()->make('telegramStorage');
    dd($users->getUser($user));
});