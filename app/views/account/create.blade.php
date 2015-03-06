@extends('layout.main')

@section('heading')
	Create an Account
@stop

@section('content')
<div class="col-md-12">
	<div class="col-lg-8 offset4 login-wrapper">
		<div class="panel panel-info">
			<div class="panel-heading">
				 <h3 class="panel-title">Fill in the form below 
				 <a href="{{URL::route('account-sign-in')}}" style="float:right; font-size:85%;">Sign In</a></h3>
			</div>
			<div class="panel-body">
				<form role="form" action="{{URL::route('account-create')}}" method="post" class="">
					<div class="form-group @if($errors->has('email')) has-error @endif" >
						<label class="control-label" for="email">Email : </label>
						<input type="text" class="form-control" name="email" {{ (Input::old('email')) ? 'value="'.e(Input::old('email')).'"' : '' }} />
						@if($errors->has('email'))
							<span class="has-error">{{$errors->first('email')}}</span>
						@endif
					</div>

					<div class="form-group @if($errors->has('username')) has-error @endif">
						<label class="control-label">Username : </label>
						<input autocomplete="false" type="text" class="form-control" name="username" {{ (Input::old('email')) ? ' value="'.e(Input::old('username')).'"' : '' }} />
						@if($errors->has('username'))
							<span class="has-error">{{$errors->first('username')}}</span>
						@endif
					</div>

					<div class="form-group @if($errors->has('password')) has-error @endif">
						<label class="control-label">Password : </label>
						<input type="password" class="form-control" name="password" />
						@if($errors->has('password'))
							<span class="has-error">{{$errors->first('password')}}</span>
						@endif
					</div>

					<div class="form-group @if($errors->has('password_again')) has-error @endif">
						<label class="control-label">Retype Password : </label>
						<input type="password" class="form-control" name="password_again"  />
						@if($errors->has('password_again'))
							<span class="has-error">{{$errors->first('password_again')}}</span>
						@endif
					</div>
				
					<div class="form-group">
						<input type="submit" value="Create Account" class="btn btn-success btn-lg" />
					</div>
					{{Form::token()}}
				</form>
			</div>
			
		</div>
				
	</div>
</div>				
@stop