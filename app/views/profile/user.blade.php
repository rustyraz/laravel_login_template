@extends ('layout.main')

@section('heading')
	{{e($user->username)}}'s profile 
@stop

@section('content')
	<div class="col-lg-12">
		<p><strong>Email :</strong> {{ e($user->email) }}</p>
		<p><strong>Date of registration</strong> {{ e($user->created_at) }}</p>
	</div>
@stop