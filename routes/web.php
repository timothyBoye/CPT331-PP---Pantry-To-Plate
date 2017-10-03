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
Route::get('/dashboard/cuisines', 'AdminCuisinesController@cuisines')->name('admin.cuisines');
Route::delete('/dashboard/cuisines/{id}', 'AdminCuisinesController@deleteCuisine')->name('admin.cuisine.delete');
Route::get('/dashboard/newCuisine', 'AdminCuisinesController@addCuisine')->name('admin.cuisine.new');
Route::get('/dashboard/cuisines/{id}', 'AdminCuisinesController@getCuisine')->name('admin.cuisine.get');
Route::post('/dashboard/cuisines/', 'AdminCuisinesController@postCuisine')->name('admin.cuisine.post');
Route::put('/dashboard/cuisines/{id}', 'AdminCuisinesController@putCuisine')->name('admin.cuisine.put');

// Ingredients
Route::get('/dashboard/ingredients', 'AdminIngredientsController@ingredients')->name('admin.ingredients');
Route::delete('/dashboard/ingredients/{id}', 'AdminIngredientsController@deleteIngredient')->name('admin.ingredient.delete');
Route::get('/dashboard/newIngredient', 'AdminIngredientsController@addIngredient')->name('admin.ingredient.new');
Route::get('/dashboard/ingredients/{id}', 'AdminIngredientsController@getIngredient')->name('admin.ingredient.get');
Route::post('/dashboard/ingredients/', 'AdminIngredientsController@postIngredient')->name('admin.ingredient.post');
Route::put('/dashboard/ingredients/{id}', 'AdminIngredientsController@putIngredient')->name('admin.ingredient.put');

// Measurements
Route::get('/dashboard/measurements', 'AdminMeasurementsController@measurements')->name('admin.measurements');
Route::delete('/dashboard/measurements/{id}', 'AdminMeasurementsController@deleteMeasurement')->name('admin.measurement.delete');
Route::get('/dashboard/newMeasurement', 'AdminMeasurementsController@addMeasurement')->name('admin.measurement.new');
Route::get('/dashboard/measurements/{id}', 'AdminMeasurementsController@getMeasurement')->name('admin.measurement.get');
Route::post('/dashboard/measurements/', 'AdminMeasurementsController@postMeasurement')->name('admin.measurement.post');
Route::put('/dashboard/measurements/{id}', 'AdminMeasurementsController@putMeasurement')->name('admin.measurement.put');

// Recipes
Route::get('/dashboard/recipes', 'AdminRecipesController@recipes')->name('admin.recipes');
Route::get('/dashboard/recipes/{id}', 'AdminRecipesController@getRecipe')->name('admin.recipe.get');
Route::get('/dashboard/newRecipe', 'AdminRecipesController@addRecipe')->name('admin.recipe.new');
Route::delete('/dashboard/recipes/{id}', 'AdminRecipesController@deleteRecipe')->name('admin.recipe.delete');
Route::post('/dashboard/recipes/', 'AdminRecipesController@postRecipe')->name('admin.recipe.post');
Route::put('/dashboard/recipes/{id}', 'AdminRecipesController@putRecipe')->name('admin.recipe.put');

// Users
Route::get('/dashboard/users', 'AdminUsersController@users')->name('admin.users');
Route::delete('/dashboard/users/{id}', 'AdminUsersController@deleteUser')->name('admin.user.delete');
Route::get('/dashboard/newUser', 'AdminUsersController@addUser')->name('admin.user.new');
Route::get('/dashboard/users/{id}', 'AdminUsersController@getUser')->name('admin.user.get');
Route::post('/dashboard/users/', 'AdminUsersController@postUser')->name('admin.user.post');
Route::put('/dashboard/users/{id}', 'AdminUsersController@putUser')->name('admin.user.put');

