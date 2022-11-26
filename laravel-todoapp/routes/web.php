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

Route::get('/todo', 'App\Http\Controllers\TodoController@index')->name('todo.index');
Route::post('/todo', 'App\Http\Controllers\TodoController@store');
Route::post('/todo/update/{id}', 'App\Http\Controllers\TodoController@update')->name('todo.update');
Route::post('todo/delete/{id}', 'App\Http\Controllers\TodoController@delete')->name('todo.delete');

Route::get('/todo/search', 'App\Http\Controllers\TodoController@search')->name('todo.search');
