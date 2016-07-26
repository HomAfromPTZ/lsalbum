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

Route::get('/', function () {
    return view('welcome');
});

Route::auth();


// Albums
Route::get('/album', 'AlbumController@index');
Route::get('/photo', 'PhotoController@index');
Route::get('/album/create', 'AlbumController@create');
Route::get('/photo/create', 'PhotoController@create');

// TODO: proper Pages, User, Photo and Album controller
Route::group(['middleware' => 'auth'], function() {
	// Pages
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
	// Route::post('/album/setBackground/{album_id}', 'AlbumController@setBackground');

	// Photo
	Route::post('/photo/save/{album_id}', 'PhotoController@save');
	Route::post('/photo/update/{photo_id}', 'PhotoController@update');
	Route::get('/photo/delete/{photo_id}', 'PhotoController@delete');

	// Comments
	Route::post('/newComment/{photo_id', 'CommentController@save');

	// Likes
	Route::get('/like/{photo_id}', 'LikeController@like');
	Route::get('/unlike/{photo_id}', 'LikeController@unlike');

	// Photo storage actions
	Route::get('/storage/getPhotos/{page}', 'StorageController@getLatestPhotos');
	Route::get('/storage/getPhotosCollection/{number}', 'StorageController@getLatestPhotosCollection');
	Route::get('/storage/getAlbumPhotos/{album_id}', 'StorageController@getAlbumPhotos');
});