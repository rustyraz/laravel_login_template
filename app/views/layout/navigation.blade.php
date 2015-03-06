<nav class="navbar navbar-default" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{URL::route('home')}}">Authentication with Laravel</a>
    </div>
  	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
      	<li><a href="{{URL::route('home')}}"><i class="fa fa-home"></i> Home</a></li>

        @if(Auth::check())
          <!--<li><a href="{{ URL::route('account-change-password') }}"><i class="fa fa-cogs"></i> Settings</a></li>
          <li><a href="{{ URL::route('account-sign-out') }}"><i class="fa fa-lock"></i> Sign Out</a></li> 
          <li><a href="#"><i class="glyphicon glyphicon-user"></i> {{ Auth::user()->username }}</a></li>-->
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-user"></i> {{ Auth::user()->username }} <i class="fa fa-sort-down"></i> </a>
            <ul class="dropdown-menu">
              <li><a href="{{ URL::route('profile-user', Auth::user()->username).'/' }}">Your Profile <span class="glyphicon glyphicon-user pull-right"></span></a></li>
              <li class="divider"></li>
              <li><a href="{{ URL::route('account-change-password') }}">Settings <span class="fa fa-cogs pull-right"></span></a></li>
              <li class="divider"></li>
              <li><a href="#">User stats <span class="glyphicon glyphicon-stats pull-right"></span></a></li>
              <li class="divider"></li>
              <li><a href="#">Messages <span class="badge pull-right"> 42 </span></a></li>
              <li class="divider"></li>
              <li><a href="{{ URL::route('account-sign-out') }}">Sign Out <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
            </ul>
          </li>         
        @else
          <li><a href="{{URL::route('account-sign-in')}}"><i class="fa fa-user"></i> Sign In</a></li>
          <li><a href="{{URL::route('account-create')}}"><i class="fa fa-edit"></i> Sign Up</a></li>
        @endif
        
      	
      </ul>
     </div>
   
	
</nav>