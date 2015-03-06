<?php
class AccountController extends BaseController {

	public function getSignIn(){
		return View::make('account.signin');
	}

	public function postSignIn(){
		$validator = Validator::make(Input::all(),
			array(
				'login_email'=>'required|email',
				'login_password'=>'required'
			)
		);

		if($validator->fails()){
			//validation failed
			return Redirect::route('account-sign-in')
			->withErrors($validator)
			->withInput();
		}else{

			$remember = (Input::has('remember_me')) ? true : false;
			//attempt sign in
			$auth = Auth::attempt(array(
				'email'=> Input::get('login_email'),
				'password' => Input::get('login_password'),
				'active' => 1
			), $remember);

			if($auth){
				//redirect to intended page
				return Redirect::intended('/');
			}else{
				return Redirect::route('account-sign-in')
				->with('global','Email/Password wrong, or account not activated')
				->withErrors($validator)
				->withInput();
			}

		}

		return Redirect::route('account-sign-in')
		->with('global','There was a problem signin you in,. Have you activated your account?');
	}

	public function getSignOut(){
		Auth::logout();
		return Redirect::route('home');
	}

	public function getCreate(){
		//return a view of the form
		return View::make('account.create');
	}

	public function postCreate(){
		//get data

		$validator = Validator::make(Input::all(), 
			array(
				'email'=>'required|email|max:100|unique:users',
				'username'=>'required|max:20|min:3|unique:users',
				'password'=>'required|min:6',
				'password_again'=>'required|same:password'
			)
		);

		if($validator->fails()){
			//die('failed');
			return Redirect::route('account-create')
			->withErrors($validator)
			->withInput();
		}else{
			//die('Success');
			$email = Input::get('email');
			$username = Input::get('username');
			$password = Input::get('password');

			//activation code
			$code = str_random(60);

			$createUser = User::create(array(
				'email'=>$email,
				'username'=> $username,
				'password' => Hash::make($password),
				'code' => $code,
				'active' => '0'
			));

			if($createUser){
				//send an activation email
				Mail::send('emails.auth.activate', 
					array('link'=>URL::route('account-activate', $code), 'username'=>$username), 
					function($message) use ($createUser){
					$message->to($createUser->email,$createUser->username)->subject('Activate your Account');
				});
				return Redirect::route('home')
				->with('global', 'Your account has been created! We have sent you an email to activate your account.');
			}

		}

	}

	public function getActive($code){
		//return $code;
		$user = User::where('code','=', $code)->where('active', '=', 0);
		if($user->count()){
			$user = $user->first();
			//echo '<pre>', print_r($user),'</pre>';
			//update user to active state
			$user->active = 1;
			$user->code = '';

			if($user->save()){
				return Redirect::route('home')
				->with('global','Account activated successlly! You can now sign in!');
			}

		}

		return Redirect::route('home')
		->with('global','We could not activate your account, please try again later!');
		
	}

	public function getChangePassword(){
		return View::make('account.password');
	}

	public function postChangePassword(){
		$validator = Validator::make(Input::all(),
		array(
			'old_password' => 'required',
			'password' => 'required|min:6',
			'password_again' => 'required|same:password'
		));

		if($validator->fails()){
			//redirect
			return Redirect::route('account-change-password')
			->withErrors($validator);
		}else{
			//change password
			$user = User::find(Auth::user()->id);

			$old_password = Input::get('old_password');
			$password = Input::get('password');

			if(Hash::check($old_password,$user->getAuthPassword())){
				$user->password = Hash::make($password);
				if($user->save()){
					return Redirect::route('home')
					->with('global', 'Your password has been changed successfully!');
				}
			}else{
				return Redirect::route('account-change-password')
				->with('global-error','Your old password is incorrect!');
			}
		}

		return Redirect::route('account-change-password')
		->with('global-error','Your password could not be changed!');

	}


	public function getUserImages(){
		return 'Upload image';
	}


	public function getForgotPassword(){
		return View::make('account.forgot');
	}

	public function postForgotPassword(){
		$validator = Validator::make(Input::all(), 
			array(
				'email'=> 'required|email'
			)
		);

		if($validator->fails()){
			return Redirect::route('account-forgot-password')
			->withErrors($validator)
			->withInput();
		}else{
			//change password
			$user = User::where('email', '=', Input::get('email'));
			if($user->count()){
				$user 			= $user->first();
				//Generate new code and password
				$code 			= str_random(60);
				$password 		= str_random(10);

				$user->code 	= $code;
				$user->password_temp = Hash::make($password);

				if($user->save()){
					Mail::send('emails.auth.forgot',
						array('link'=>URL::route('account-recover', $code),
							'username'=> $user->username,
							'password'=> $password
						),
						function($message) use ($user){
							$message->to($user->email,  $user->username)
							->subject('Your new password');
						}
					);

					return Redirect::route('home')
					->with('global-info', 'We have sent you a new password via your email');

				}
			}else{
				return Redirect::route('account-forgot-password')
				->withInput()
				->with('global-error','We could not process your request, please make sure you have used the right email!');
			}
		}

		return Redirect::route('account-forgot-password')
		->with('global-error','Could not request a new password!');

	}

	public function getRecover($code){
		$user = User::where('code', '=', $code)
		->where('password_temp','!=', $code);

		if($user->count()){
			$user = $user->first();
			$user->password 		= $user->password_temp;
			$user->password_temp 	= '';
			$user->code 			='';

			if($user->save()){
				return Redirect::route('home')
				->with('global', 'Your account has been recovered and you can now login using your new password');
			}
		}

		return Redirect::route('home')
		->with('global-error', 'We could not recover your account from our database');
	}
}