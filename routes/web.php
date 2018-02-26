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

Route::group(['middleware' => 'web'], function () {

	// Call the signupUser method in UserController class.
	Route::post('/signup_user', [
		'uses' => 'UserController@signupUser', 
		'as' => 'signup_user'
	]);

	// Call the loginUser method in UserController class.
	Route::post('/login_user',  [
		'uses' => 'UserController@loginUser',
		'as' => 'login_user'
	]);

	// Call the logoutUser method in UserController class.
	Route::post('/logout_user', [
		'uses' => 'UserController@logoutUser',
		'as' => 'logout_user'
	]);

	// Call the uploadPic method in UserController class.
	Route::post('/upload', [
		'uses' => 'UserController@uploadPic',
		'as' => 'upload-pic'
	]);

	// Call the likeMemo method in LikeController class.
	Route::post('/like', [
		'uses' => 'MemoController@likeMemo',
		'as' => 'like'
	]);

	// Register the Memo resource.
	Route::resource('/memo', 'MemoController');

	// Return the Dashboard.
	Route::get('/dashboard', [
		'uses' => 'PageController@getDashboardPage',
		'as' => 'dashboard',
		'middleware' => 'auth'
	]);

	// Return the Favourites.
	Route::get('/favourites', [
		'uses' => 'PageController@getFavouritesPage',
		'as' => 'favourites',
		'middleware' => 'auth'
	]);

	// Return the Login Page.
	Route::get('/login', [ 
		'uses' => 'PageController@getLoginPage', 
		'as' => 'login-page' 
	]);

	// Return the Edit Page.
	Route::get('/create', [
		'uses' => 'PageController@getCreatePage',
		'as' => 'create-page',
		'middleware' => 'auth'
	]);

	// Return the Register Page.
	Route::get('/signup', [
		'uses' => 'PageController@getSignupPage',
		'as' => 'signup-page'
	]);

	// Return the Home Page.
	Route::get('/', [ 
		'uses' => 'PageController@getSignupPage', 
		'as' => 'home' 
	]);

});
