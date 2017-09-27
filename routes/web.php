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

Route::get('/profile/cuisines',['as' => 'profile.cuisines', 'uses' => 'UserProfileController@get_cuisines']);
Route::post('/profile/cuisines',['as' => 'profile.cuisines.update', 'uses' => 'UserProfileController@update']);


Route::get('/dashboard', 'AdminController@index')->name('admin');
Route::get('/dashboard/cuisines', 'AdminController@cuisines')->name('admin.cuisines');
Route::get('/dashboard/ingredients', 'AdminController@ingredients')->name('admin.ingredients');
Route::get('/dashboard/measurements', 'AdminController@measurements')->name('admin.measurements');
Route::get('/dashboard/recipes', 'AdminController@recipes')->name('admin.recipes');
Route::get('/dashboard/users', 'AdminController@users')->name('admin.users');
