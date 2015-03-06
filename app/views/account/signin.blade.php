@extends('layout.main')

@section('heading')
	Sign in Form
@stop

@section('content')
<div class="col-md-12">
	<div class="col-lg-6 offset4 login-wrapper">
		<div class="panel panel-info">
			<div class="panel-heading">
				 <h3 class="panel-title">Login here</h3>
			</div>
			<div class="panel-body">
				<form action="{{ URL::route('account-sign-in-post') }}" method="post">
					<div class="form-group @if($errors->has('login_email')) has-error @endif">
						<div class="input-group">
			                <span class="input-group-addon input-small"><i class="glyphicon glyphicon-envelope"></i></span>
			                <input type="text" id="login_email" name="login_email" class="form-control input-small" {{ (Input::old('login_email')) ? 'value="'.e(Input::old('login_email')).'"' : '' }} placeholder="Your Email">
			            </div>
						@if($errors->has('login_email'))
							<span class="has-error">{{$errors->first('login_email')}}</span>
						@endif
					</div>

					<div class="form-group @if($errors->has('login_password')) has-error @endif">
						<div class="input-group">
			                <span class="input-group-addon input-small"><i class="glyphicon glyphicon-lock"></i></span>
			                <input type="password" id="login_password" name="login_password" class="form-control input-small" placeholder="Your Password">
			            </div>
						@if($errors->has('login_password'))
							<span class="has-error">{{$errors->first('login_passwsord')}}</span>
						@endif
					</div>

					<div class="form-group">
						<label class="control-label"><input type="checkbox" class="" name="remember_me" id="remember_me"  /> Remember me </label>
						<a href="{{ URL::route('account-forgot-password') }}" style="float:right; font-size:85%;">forgot password?</a>			
					</div>
				
					<div class="form-group">
						<input type="submit" value="Sign In" class="btn btn-primary btn-lg btn-block" />
					</div>

					<div class="form-group">
						<div style="border-top: 1px solid#888; padding-top:15px; font-size:85%">
		                    Don't have an account! 
		                    <a href="{{URL::route('account-create')}}">Sign Up here</a>
		                </div>
					</div>

					{{Form::token()}}
				</form>
			</div>
			
		</div>
				
	</div>
</div>		
@stop