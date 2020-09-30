@extends('layouts.default')
@section('title','登录')
@section('content')
<div class="offset-md-2 col-md-8">
	<div class="card">
		<div class="card-header">
			<h2>登录</h2>
		</div>
		<div class="card-body">
			@include('shared._errors')
			<form method="POST" action="{{ route('login') }}" >
				{{ csrf_field() }}
				<div class="form-group">
					<label for="email">邮箱：</label>
					<input type="text" name="email" class="form-control" value="{{ old('email') }}">
				</div>
				<div class="form-group">
					<label for="password">密码：&nbsp;&nbsp;<a href="{{route('password.request')}}">忘记密码？</a></label>
					<input type="password" name="password" class="form-control" value="{{ old('password') }}">
				</div>
				<div class="form-group">
					<div class="form-check">
						<label class="form-check-label"><input type="checkbox" class="form-check-input" name="remember">记住账号</label>
					</div>
				</div>
				<button type="submit" class="btn btn-primary">登录</button>
			</form>
			<hr>
			<p>没有账号？<a href="{{ route('signup') }}">前往注册</a></p>
		</div>
	</div>
</div>
@stop