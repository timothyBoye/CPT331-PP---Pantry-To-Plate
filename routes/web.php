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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index');

Route::post('/result', 'RecipeResultsController@getResults')->name('result');

Route::get('/recipe/{id}', 'RecipeResultsController@show')->name('recipe');

Route::get('/dashboard', 'AdminController@index')->name('admin');