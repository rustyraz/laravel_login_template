<?php
Route::get('/', array(
	'as'=>'home',
	'uses'=>'HomeController@home'
) );

Route::get('/user/{username}',array(
	'as'=>'profile-user',
	'uses'=>'ProfileController@user'
));

Route::get('/user/',array(
	'as'=>'profile',
	'uses'=>'ProfileController@index'
));


/*Authenticated group*/
Route::group(array('before' => 'auth'), function(){
	/*change password (GET)*/
	Route::get('/account/change-password',array(
		'as' =>'account-change-password',
		'uses' => 'AccountController@getChangePassword'		
	));

	/*CSRF protection group*/
	Route::group(array('before'=>'csrf'), function(){
		/*change password (POST)*/
		Route::post('/account/change-password',array(
			'as' =>'account-change-password-post',
			'uses' => 'AccountController@postChangePassword'		
		));
						
	});


	/*Sign out (GET)*/
	Route::get('/account/sign-out', array(
		'as' => 'account-sign-out',
		'uses' => 'AccountController@getSignout'
	));


	/*Upload image*/
	Route::get('/uploads/upload-image',array(
		'as'=>'upload-image',
		'uses'=> 'UploadController@getImageUploadForm'
	));

	/*Upload image*/
	Route::get('/uploads/',array(
		'as'=>'upload-image',
		'uses'=> 'UploadController@getImageUploadForm'
	));

	Route::post('/uploads/saveImage',array(
		'as'=>'save-image',
		'uses'=>'UploadController@saveImage'
	));

});


Route::get('/account/create', array(
		'as'=> 'account-create',
		'uses'=> 'AccountController@getCreate'
	));

/*
	Unauthenticated Group
*/
Route::group(array('before' => 'guest'), function(){

	//CSRF protection group
	Route::group(array('before'=>'csrf'), function(){

		//create an account
		Route::post('/account/create', array(
			'as'=> 'account-create-post',
			'uses'=> 'AccountController@postCreate'
		));


		//Sign in an account
		Route::post('/account/sign-in', array(
			'as'=> 'account-sign-in-post',
			'uses'=> 'AccountController@postSignIn'
		));

		/*forgot password*/
		Route::post('/account/forgot-password', [
			'as'=>'account-forgot-password-post',
			'uses'=>'AccountController@postForgotPassword'
		]);

	});

	/*Forgot a password*/
	Route::get('/account/forgot-password',[
		'as'=>'account-forgot-password',
		'uses'=>'AccountController@getForgotPassword'
	]);

	Route::get('/account/recover/{code}',[
		'as'=>'account-recover',
		'uses'=>'AccountController@getRecover'
	]);

	/*Sign in account (GET)*/
	Route::get('/account/sign-in',array(
		'as'=>'account-sign-in',
		'uses'=>'AccountController@getSignIn'
	));
	/*Create account (GET)*/
	Route::get('/account/create', array(
		'as'=> 'account-create',
		'uses'=> 'AccountController@getCreate'
	));

	Route::get('/account/activate/{code}', array(
		'as'=>'account-activate',
		'uses'=>'AccountController@getActive'
	));

});