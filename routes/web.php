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
Route::post('/recipe/setRating', 'RecipeResultsController@setRating')->name('setRating');

Route::get('/profile/cuisines',['as' => 'profile.cuisines', 'uses' => 'UserProfileController@get_cuisines']);
Route::post('/profile/cuisines',['as' => 'profile.cuisines.update', 'uses' => 'UserProfileController@update']);




/*
 * ADMIN
 */
Route::get('/dashboard', 'AdminController@index')->name('admin');
// Cuisines
Route::get('/dashboard/cuisines', 'AdminController@cuisines')->name('admin.cuisines');
Route::delete('/dashboard/cuisines/{id}', 'AdminController@deleteCuisine')->name('admin.cuisine.delete');
Route::get('/dashboard/newCuisine', 'AdminController@addCuisine')->name('admin.cuisine.new');
Route::get('/dashboard/cuisines/{id}', 'AdminController@getCuisine')->name('admin.cuisine.get');
Route::post('/dashboard/cuisines/', 'AdminController@postCuisine')->name('admin.cuisine.post');
Route::put('/dashboard/cuisines/{id}', 'AdminController@putCuisine')->name('admin.cuisine.put');

// Ingredients
Route::get('/dashboard/ingredients', 'AdminController@ingredients')->name('admin.ingredients');
Route::delete('/dashboard/ingredients/{id}', 'AdminController@deleteIngredient')->name('admin.ingredient.delete');
Route::get('/dashboard/newIngredient', 'AdminController@addIngredient')->name('admin.ingredient.new');
Route::get('/dashboard/ingredients/{id}', 'AdminController@getIngredient')->name('admin.ingredient.get');
Route::post('/dashboard/ingredients/', 'AdminController@postIngredient')->name('admin.ingredient.post');
Route::put('/dashboard/ingredients/{id}', 'AdminController@putIngredient')->name('admin.ingredient.put');

// Measurements
Route::get('/dashboard/measurements', 'AdminController@measurements')->name('admin.measurements');
Route::delete('/dashboard/measurements/{id}', 'AdminController@deleteMeasurement')->name('admin.measurement.delete');
Route::get('/dashboard/newMeasurement', 'AdminController@addMeasurement')->name('admin.measurement.new');
Route::get('/dashboard/measurements/{id}', 'AdminController@getMeasurement')->name('admin.measurement.get');
Route::post('/dashboard/measurements/', 'AdminController@postMeasurement')->name('admin.measurement.post');
Route::put('/dashboard/measurements/{id}', 'AdminController@putMeasurement')->name('admin.measurement.put');

// Recipes
Route::get('/dashboard/recipes', 'AdminController@recipes')->name('admin.recipes');
Route::get('/dashboard/recipes/{id}', 'AdminController@getRecipe')->name('admin.recipe.get');
Route::get('/dashboard/newRecipe', 'AdminController@addRecipe')->name('admin.recipe.new');
Route::delete('/dashboard/recipes/{id}', 'AdminController@deleteRecipe')->name('admin.recipe.delete');
Route::post('/dashboard/recipes/', 'AdminController@postRecipe')->name('admin.recipe.post');
Route::put('/dashboard/recipes/{id}', 'AdminController@putRecipe')->name('admin.recipe.put');

// Users
Route::get('/dashboard/users', 'AdminController@users')->name('admin.users');
Route::delete('/dashboard/users/{id}', 'AdminController@deleteUser')->name('admin.user.delete');
Route::get('/dashboard/newUser', 'AdminController@addUser')->name('admin.user.new');
Route::get('/dashboard/users/{id}', 'AdminController@getUser')->name('admin.user.get');
Route::post('/dashboard/users/', 'AdminController@postUser')->name('admin.user.post');
Route::put('/dashboard/users/{id}', 'AdminController@putUser')->name('admin.user.put');

