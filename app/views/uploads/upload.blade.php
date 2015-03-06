@extends('layout.main')

@section('heading')
	Upload an image
@stop

@section('content')
	{{ $user->email }}
	<form role="form" action="{{URL::route('save-image')}}" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="control-label">Image</label>
			<input type="file" name="image_file" id="image_file" />
		</div>
		<div class="form-group">
			<input type="submit" value="Save" class="button btn btn-primary" />
		</div>
	</form>

@stop