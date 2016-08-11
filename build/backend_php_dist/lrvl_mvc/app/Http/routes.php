<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'PageController@index');

// Auth routes
Route::auth();
Route::post('/login', 'Auth\AuthController@postLogin');
Route::post('/register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('/password/email', 'Auth\PasswordController@getEmail');
Route::post('/password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('/password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('/password/reset', 'Auth\PasswordController@postReset');

// DEBUG ALBUMS (remove on prod)
Route::get('/album/create', 'AlbumController@create');
Route::get('/photo/create', 'PhotoController@create');

Route::group(['middleware' => 'auth'], function() {
	// Pages
	Route::get('/debug', 'PageController@debug'); // TODO: Remove on prod
	Route::get('/home', 'PageController@home');
	Route::get('/user/{id}', 'PageController@user');
	Route::get('/search', 'PageController@search');
	Route::get('/album/{id}', 'PageController@album');

	// User
	Route::post('/user/savedata', 'UserController@saveData');

	// Album
	Route::post('/album/save', 'AlbumController@save');
	Route::post('/album/update/{album_id}', 'AlbumController@update');
	Route::get('/album/delete/{album_id}', 'AlbumController@delete');

	// Photo
	Route::post('/photo/save/{album_id}', 'PhotoController@save');
	Route::post('/photo/update/{photo_id}', 'PhotoController@update');
	Route::get('/photo/delete/{photo_id}', 'PhotoController@delete');

	// Comments
	Route::post('/comment/{photo_id}', 'CommentController@save');

	// Likes
	Route::get('/like/{photo_id}', 'LikeController@like');
	Route::get('/unlike/{photo_id}', 'LikeController@unlike');

	// Photo storage actions
	Route::get('/storage/getPhotos/{pagenum}', 'StorageController@getLatestPhotos');
	Route::get('/storage/getPhotosCollection/{number}', 'StorageController@getLatestPhotosCollection');
	Route::get('/storage/getAlbumPhotos/{album_id}', 'StorageController@getAlbumPhotos');
});