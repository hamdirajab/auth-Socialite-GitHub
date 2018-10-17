<?php


Route::get('/', function () {
    return view('welcome');
});

Route::get('login/github', 'Auth\LoginController@redirectToProvider');
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');


Auth::routes();

Route::get('homes',function(){
	
	return "welcom you are login";

})->middleware('auth');


Route::get('logout',function(){
	
	auth()->logout();

	return redirect('/');
});

