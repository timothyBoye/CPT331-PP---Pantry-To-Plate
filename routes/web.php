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
Route::get('/about', ['as' => 'about', 'uses' => 'AboutController@index']);
Route::post('/result', 'RecipeResultsController@getResults')->name('result');
Route::get('/recipe/{id}', 'RecipeResultsController@show')->name('recipe');
Route::post('/recipe/setRating', 'RecipeResultsController@setRating')->name('setRating');

Route::get('/profile/cuisines',['as' => 'profile.cuisines', 'uses' => 'UserProfileController@get_cuisines']);
Route::post('/profile/cuisines',['as' => 'profile.cuisines.update', 'uses' => 'UserProfileController@update']);
Route::post('/profile/save_recipe', ['as' => 'profile.save_recipe', 'uses' => 'SavedRecipesController@save']);
Route::get('/profile/saved_recipes', ['as' => 'profile.saved_recipes', 'uses' => 'SavedRecipesController@get']);
Route::post('/profile/delete_recipe', ['as' => 'profile.delete_recipe', 'uses' => 'SavedRecipesController@delete']);
Route::get('search','SearchResultsController@getSearchResults')->name('search');



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
Route::post('/dashboard/cuisines/seeder/{id}', 'AdminCuisinesController@seedString')->name('admin.cuisine.seeder');

// Ingredients
Route::get('/dashboard/ingredients', 'AdminIngredientsController@ingredients')->name('admin.ingredients');
Route::delete('/dashboard/ingredients/{id}', 'AdminIngredientsController@deleteIngredient')->name('admin.ingredient.delete');
Route::get('/dashboard/newIngredient', 'AdminIngredientsController@addIngredient')->name('admin.ingredient.new');
Route::get('/dashboard/ingredients/{id}', 'AdminIngredientsController@getIngredient')->name('admin.ingredient.get');
Route::post('/dashboard/ingredients/', 'AdminIngredientsController@postIngredient')->name('admin.ingredient.post');
Route::put('/dashboard/ingredients/{id}', 'AdminIngredientsController@putIngredient')->name('admin.ingredient.put');
Route::post('/dashboard/ingredients/seeder/{id}', 'AdminIngredientsController@seedString')->name('admin.ingredient.seeder');

// Measurements
Route::get('/dashboard/measurements', 'AdminMeasurementsController@measurements')->name('admin.measurements');
Route::delete('/dashboard/measurements/{id}', 'AdminMeasurementsController@deleteMeasurement')->name('admin.measurement.delete');
Route::get('/dashboard/newMeasurement', 'AdminMeasurementsController@addMeasurement')->name('admin.measurement.new');
Route::get('/dashboard/measurements/{id}', 'AdminMeasurementsController@getMeasurement')->name('admin.measurement.get');
Route::post('/dashboard/measurements/', 'AdminMeasurementsController@postMeasurement')->name('admin.measurement.post');
Route::put('/dashboard/measurements/{id}', 'AdminMeasurementsController@putMeasurement')->name('admin.measurement.put');
Route::post('/dashboard/measurements/seeder/{id}', 'AdminMeasurementsController@seedString')->name('admin.measurement.seeder');

// Recipes
Route::get('/dashboard/recipes', 'AdminRecipesController@recipes')->name('admin.recipes');
Route::get('/dashboard/recipes/{id}', 'AdminRecipesController@getRecipe')->name('admin.recipe.get');
Route::get('/dashboard/recipes/ingredients/{id}', 'AdminRecipesController@getIngredients')->name('admin.recipe.ingredients.get');
Route::get('/dashboard/recipes/methods/{id}', 'AdminRecipesController@getMethods')->name('admin.recipe.methods.get');
Route::get('/dashboard/newRecipe', 'AdminRecipesController@addRecipe')->name('admin.recipe.new');
Route::delete('/dashboard/recipes/{id}', 'AdminRecipesController@deleteRecipe')->name('admin.recipe.delete');
Route::post('/dashboard/recipes/', 'AdminRecipesController@postRecipe')->name('admin.recipe.post');
Route::post('/dashboard/recipes/ingredients/{id}', 'AdminRecipesController@postRecipeIngredients')->name('admin.recipe.ingredients.post');
Route::post('/dashboard/recipes/methods/{id}', 'AdminRecipesController@postRecipeMethods')->name('admin.recipe.methods.post');
Route::put('/dashboard/recipes/{id}', 'AdminRecipesController@putRecipe')->name('admin.recipe.put');
Route::post('/dashboard/recipes/seeder/{id}', 'AdminRecipesController@seedString')->name('admin.recipe.seeder');

// Users
Route::get('/dashboard/users', 'AdminUsersController@users')->name('admin.users');
Route::delete('/dashboard/users/{id}', 'AdminUsersController@deleteUser')->name('admin.user.delete');
Route::get('/dashboard/newUser', 'AdminUsersController@addUser')->name('admin.user.new');
Route::get('/dashboard/users/{id}', 'AdminUsersController@getUser')->name('admin.user.get');
Route::post('/dashboard/users/', 'AdminUsersController@postUser')->name('admin.user.post');
Route::put('/dashboard/users/{id}', 'AdminUsersController@putUser')->name('admin.user.put');
Route::post('/dashboard/users/seeder/{id}', 'AdminUsersController@seedString')->name('admin.user.seeder');

