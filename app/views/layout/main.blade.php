<!DOCTYPE html>
<html>
	<head>
		<title>Authentication System</title>
		<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
		{{ HTML::style('public/css/custom.css') }}
	</head>
	<body>
		@include('layout.navigation')
		<div class="container">
			<div class="row">
				
				@if(Session::has('global'))
					<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> {{Session::get('global')}}</div>
				@endif

				@if(Session::has('global-error'))
					<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> {{Session::get('global-error')}}</div>
				@endif

				@if(Session::has('global-info'))
					<div class="alert alert-info"><span class="glyphicon glyphicon-exclamation-sign"></span> {{Session::get('global-info')}}</div>
				@endif

				@yield('content')
					
				
			</div>
		</div>
		<div id="footer">
	      <div class="container">
	        <p class="text-muted">@yield('footer')</p>
	      </div>
	    </div>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	</body>
</html>