@extends('layout.main')

@section('heading')
	Change Password
@stop

@section('content')
<div class="col-md-12">
<div class="col-lg-8 offset4 login-wrapper">
	<div class="panel panel-info">
	  	<div class="panel-heading">
	        <h3 class="panel-title">Changing the account password</h3>
	    </div>
	  <div class="panel-body">
	    <form action="{{URL::route('account-change-password-post')}}" method="post">
			<div class="form-group @if($errors->has('old_password')) has-error @endif">
				<label class="control-label">Old Password : </label>
				<input type="password" class="form-control" name="old_password"  />	
				@if($errors->has('old_password'))
					<span class="has-error">{{$errors->first('old_password')}}</span>
				@endif	
			</div>

			<div class="form-group @if($errors->has('password')) has-error @endif">
				<label class="control-label">New Password : </label>
				<input type="password" class="form-control" name="password"  />	
				@if($errors->has('password'))
					<span class="has-error">{{$errors->first('password')}}</span>
				@endif		
			</div>

			<div class="form-group @if($errors->has('password_again')) has-error @endif">
				<label class="control-label">Retype New Password : </label>
				<input type="password" class="form-control" name="password_again"  />
				@if($errors->has('password_again'))
					<span class="has-error">{{$errors->first('password_again')}}</span>
				@endif			
			</div>

			<div class="form-group">
				<input type="submit" value="Change Password" class="btn btn-primary btn-lg" />
			</div>
			{{Form::token()}}
		</form>
	  </div>
	</div>
</div>
</div>
		
@stop