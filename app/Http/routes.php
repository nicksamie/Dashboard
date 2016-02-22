<?php
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/a/b/c', function () {
    return view('pages.dashboard');
});
Route::Delete('schema/delete', ['as' =>'delete', 'uses' =>'SchemaController@deleteSelectedRows']);
Route::GET('schema/update', ['uses' => 'SchemaController@updateChangesSchema']);
Route::GET('schema/hold', ['uses' => 'SchemaController@holdSchema']);
Route::GET('schema/viewtables/{schemaname}',['uses' => 'SchemaController@viewTables']);

Route::GET('schema/deletesinglerow', ['uses' => 'SchemaController@deleteSingleSelectedRow']);


// User Routes
Route::get('/add-new-user', ['uses' => 'UserController@addNewUser']);
Route::post('/user/addnewuser' ,['uses' => 'UserController@saveNewUser']);
Route::get('/user/profile/{id}', ['uses' => 'UserController@showProfile']);
Route::get('/user/delete/{id}', ['uses' =>'UserController@deleteParticularUserById']);
Route::get('/user/edit/{id}', ['uses' =>'UserController@getEditUser']);
Route::post('/user/edit', ['uses' =>'UserController@postEditUser']);

// Provide controller methods with object instead of ID
Route::model('user', 'User');
Route::model('schema', 'Schema');

Route::resource('home', 'HomeController');
Route::resource('schema', 'SchemaController');
Route::resource('user', 'UserController');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@authenticate');
Route::get('auth/logout', 'Auth\AuthController@doLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::controllers([
  'auth' => 'Auth\AuthController',
  'password' => 'Auth\PasswordController',
]);