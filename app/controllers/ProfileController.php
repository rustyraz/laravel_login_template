<?php
class ProfileController extends BaseController{
	
	public function index(){
		return View::make('profile.nouserfound');
	}

	public function user($username){
		$user = User::where('username','=',$username);
		if($user->count()){
			$user = $user->first();
			return View::make('profile.user')
			->with('user',$user);
		}
		//return App::abort(404);
		return View::make('profile.nouserfound');
	}

}