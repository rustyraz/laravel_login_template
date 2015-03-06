@extends('layout.main')

@section('heading')
	@if(Auth::check())
		<h4>Hello, {{ Auth::user()->username }}</h4>

	@else
		<h4>You need to sign in</h4>
	@endif
@stop

@section('content')
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body">
			@if(Auth::check())
				<p>Content viewable to logged in users</p>
			@else
				<p>Content seen by guest users</p>
			@endif
		</div>
			
	</div>
	
</div>
@stop

@section('footer')
	Footer will come here
@stop