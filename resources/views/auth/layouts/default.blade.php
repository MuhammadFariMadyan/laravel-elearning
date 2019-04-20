<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>E-Learning SMP PGRI 1</title>
	<link rel="stylesheet" type="text/css" href="{{URL::to('asset/css/bootstrap.min.css')}}">
	@yield('styles')
</head>
<body>
<div class="container-fluid">
	<div class="row">
		@yield('banner')
	</div>
	<div class="row">
		@yield('content')
	</div>
	<div class="row">
		@yield('footer')
	</div>
</div>
</body>
@yield('scripts')
<script type="text/javascript" src="{{URL::to('asset/jquery.js')}}"></script>
<script type="text/javascript" src="{{URL::to('asset/js/bootstrap.min.js')}}"></script>
</html>