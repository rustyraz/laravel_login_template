<?php
class UploadController extends BaseController{
	public function Index(){
		//return View::make('uploads.upload');
		//return Redirect::route('uploads.upload', array('user' => 1));		
	}

	public function missingMethod($parameters = array())
	{
	    //
	}

	public function getImageUploadForm(){
		$user = User::find(Auth::user()->id);
		if($user->count()){
			$user = $user->first();
			return View::make('uploads.upload')
			->with('user',$user);
			//return Redirect::route('upload-image', array('user' => 1));	

		}
		return View::make('uploads.upload');		
	}

	public function saveImage(){
		$file = Input::file('image_file');
 
		$destinationPath = 'public/uploads/';
		$filename = str_random(100);
		//$filename = $file->getClientOriginalName();
		$extension =$file->getClientOriginalExtension();
		$filename .= '.'.$extension; 
		$upload_success = Input::file('image_file')->move($destinationPath, $filename);
		 
		if( $upload_success ) {
		   //return Response::json('success', 200);
		  // return View::make('uploads.upload');
		   return Redirect::route('upload-image')
				->with('global','Photo Uploaded successfully');
		} else {
		   return Response::json('error', 400);
		}
	}
}
?>