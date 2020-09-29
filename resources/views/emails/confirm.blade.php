<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>注册确认链接</title>
</head>
<body>
	<h1>感谢您注册美莱微博系统！</h1>
	<p>
		请点击或者复制下方链接完成注册：
		<a href="{{ route('confirm_email', $user->activation_token) }}">{{ route('confirm_email', $user->activation_token) }}</a>
		<!-- http://laravel.dz/signup/confirm/dasdsaddsd -->
	</p>
</body>
</html>