<?php

Route::get('testschema', function(){
	return view('schema.show');
});

Route::Delete('delete_row', ['uses' =>'SchemaController@deleteParticularRow']);

Route::Delete('schema/delete', ['as' =>'delete', 'uses' =>'SchemaController@deleteSelectedRows']);

Route::controllers([
  'auth' => 'Auth\AuthController',
  'password' => 'Auth\PasswordController',
]);

// Provide controller methods with object instead of ID
Route::model('user', 'User');
Route::model('schema', 'Schema');

Route::resource('home', 'HomeController');
Route::resource('schema', 'SchemaController');
Route::resource('user', 'UserController');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// User Routes
Route::get('/user/add', [ 'as' => 'profile','uses' => 'UserController@addNewUser']);
Route::get('/user/profile/{id}', ['uses' => 'UserController@showProfile']);

//Route::get('user/profile', 'UserController@showProfile');
/*Route::post('/task', 'UserController@store');
Route::delete('/task/{task}', 'UserController@destroy');

// Task Routes
Route::get('/sch', 'SchemaController@index');
Route::post('/task', 'SchemaController@store');
Route::delete('/task/{task}', 'SchemaController@destroy');
*/


/*Route::get('/hom', function () {
   
});*/
/*Route::controllers([
   'password' => 'Auth\PasswordController',
]);



Route::get('/user/add', 'UserController@createNewUser');
//Route::get('user/{id}', 'UserController@showProfile');
*/

//Route::get('user/show', ['uses' => 'UserController@showUsers']);
//Route::get('user/show', ['uses' => 'UserController@getShowUsers']);
//Route::get('user/add', 'UserController@create');
//

//Route::get('user/{id}', 'UserController@showProfile');
