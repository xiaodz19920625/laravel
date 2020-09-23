<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>美莱-@yield('title','')</title>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
	<div id="app">	
		@include('layouts._header')
		<div class="container">
			<div class="offset-mid-1 col-md-10">
				@include('shared._messages')
				@yield('content')
				@include('layouts._footer')
			</div>
		</div>
	</div>
	<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>