@extends('auth.layouts.default')

@section('styles')
<style type="text/css">
	body{
		
		background: url('{{URL::to('asset/images/pgri6.jpg')}}') no-repeat center center fixed; 
 		 -webkit-background-size: cover;
 	 -moz-background-size: cover;
 	 -o-background-size: cover;
 	 background-size: cover;

	}
	.input-group{
		margin-bottom: 20px;
	}
	#TitleForm{
		margin-top: 1%;
		margin-bottom: 1%;
		margin-left: 12%;
		margin-right: 12%;
		opacity: 0.9;
		border-radius: 25px;
		opacity: 0.9;
	}
	#loginForm{
		margin-top: 5%;
		margin-bottom: 1%;
		opacity: 0.9;
		border-radius: 10px;
		opacity: 0.9;
	}
	
	#logo-pgri{
		margin-top: -80px;
	}
</style>
@endsection

@section('banner')

@endsection

@section('content')
<div class="col-md-9 well" id="TitleForm" >
	<center>  		
		<strong><h3>Selamat Datang di Sistem Informasi E-Learning pada SMP PGRI 1 Bandar Lampung</h3></strong>
	</center>
</div>
<div class="col-md-4 col-md-offset-4 well" id="loginForm">
	<center>  
		<img src="{{URL::to('asset/images/logo-pgri1.jpg')}}" height="180px" width="260px" id="logo-pgri">
		<h3>Login</h3>
	</center>
		@if(count($errors) > 0)
			<div class="alert alert-danger" style="text-align: center;">
				<ul>
					@foreach($errors->all() as $error)
						<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
		@endif	
	<form id="form-login" name="form-login"  action="{{ url('/login') }}" method="post" autocomplete="off">
		{{csrf_field()}}
		<div class="input-group">
			<span class="input-group-addon" id="addon1"><i class="glyphicon glyphicon-user"></i></span>
			<input type="text" id="username" name="username" class="form-control input-lg" aria-describedby="addon1" placeholder="Username">
			
		</div>
		<div class="input-group">
			<span class="input-group-addon" id="addon1"><i class="glyphicon glyphicon-lock"></i></span>
			<input type="password" id="password" name="password" class="form-control input-lg" aria-describedby="addon1" placeholder="Password">
			 
		</div>
		<button type="submit" class="btn btn-danger btn-block btn-lg" value="Login"><font style="color:black"> Login </font></button>
	</form>
</div>
@endsection

@section('footer')

@endsection

@section('scripts')

@endsection