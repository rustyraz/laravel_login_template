@extends('layout.main')

@section('content')
				
<div class="col-md-12">
	<div class="col-lg-6 offset4 login-wrapper">
		<div class="panel panel-info">
			<div class="panel-heading">
				 <h3 class="panel-title">Resetting password</h3>
			</div>
			<div class="panel-body">
				<form action="{{ URL::route('account-forgot-password-post') }}" method="POST">
					<div class="form-group @if($errors->has('email')) has-error @endif">
						<div class="input-group">
			                <span class="input-group-addon input-small"><i class="glyphicon glyphicon-envelope"></i></span>
			                <input type="text" id="email" name="email" class="form-control input-small" {{ (Input::old('email')) ? 'value="'.e(Input::old('email')).'"' : '' }} placeholder="Enter Your Email">
			            </div>
						@if($errors->has('email'))
							<span class="has-error">{{$errors->first('email')}}</span>
						@endif
					</div>
					<div class="form-group">
						<input type="submit" value="Recover" class="btn btn-primary btn-lg btn-block" />
					</div>
					{{Form::token()}}
				</form>
			</div>
			
		</div>
				
	</div>
</div>	
@stop