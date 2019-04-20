@extends('auth.layouts.default')

@section('styles')
<style type="text/css">
	body{
		
		background: url('{{URL::to('asset/images/pgri7.jpg')}}') no-repeat center center fixed; 
 		 -webkit-background-size: cover;
 	 -moz-background-size: cover;
 	 -o-background-size: cover;
 	 background-size: cover;

	}
	.input-group{
		margin-bottom: 20px;
	}
	#loginForm{
		margin-top: 10%;
		opacity: 0.9;
		border-radius: 10px;
		opacity: 0.9;
	}
	#pgri7{
		margin-top: -80px;
	}
</style>
@endsection

@section('banner')

@endsection

@section('content')
<div class="col-md-4 col-md-offset-4 well" id="loginForm">
	<center>
		<img src="{{URL::to('asset/images/pgri7.png')}}" height="120px" width="120px" id="pgri7">
		<h3>Login</h3>
	</center>
		@if(count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
						<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
		@endif
	<form action="{{route('loginVerify')}}" method="post">
		{{csrf_field()}}
		<div class="input-group">
			<span class="input-group-addon" id="addon1"><i class="glyphicon glyphicon-user"></i></span>
			<input type="text" name="id" class="form-control input-lg" aria-describedby="addon1" placeholder="Username">
		</div>
		<div class="input-group">
			<span class="input-group-addon" id="addon1"><i class="glyphicon glyphicon-lock"></i></span>
			<input type="password" name="password" class="form-control input-lg" aria-describedby="addon1" placeholder="Password">
		</div>
		<button type="submit" class="btn btn-primary btn-block btn-lg">LOGIN</button>
	</form>
</div>
@endsection

@section('footer')

@endsection

@section('scripts')

@endsection