<?php

class HomeController extends BaseController {

	public function home(){
		/*Mail::send('emails.auth.test', array('name'=> 'Peter'), function($message){
			$message->to('pngesh@yahoo.com', 'Peter Ngesh')->subject('Test email');
		});*/
		
		//$user = User::find(1);
		//echo '<pre>',print_r($user),'</pre>';

		return View::make('home');
	}

}