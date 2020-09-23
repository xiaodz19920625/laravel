@extends('layouts.default')
@section('title','更新个人信息')
@section('content')
<div class="offset-md-2 col-md-8">
	<div class="card">
		<div class="card-header">
			<h2>更新个人信息</h2>
		</div>
		<div class="card-body">
			@include('shared._errors')
			<form method="POST" action="{{ route('users.update',$user->id) }}" >
				{{ method_field('PATCH') }}
				{{ csrf_field() }}
				<div class="form-group">
					<label for="name">名称：</label>
					<input type="text" name="name" class="form-control" value="{{ $user->name }}">
				</div>
				<div class="form-group">
					<label for="email">邮箱：</label>
					<input type="text" name="email" class="form-control" disabled value="{{ $user->email }}">
				</div>
				<div class="form-group">
					<label for="password">密码：</label>
					<input type="password" name="password" class="form-control" value="{{ old('password') }}">
				</div>
				<div class="form-group">
					<label for="password">确认密码：</label>
					<input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
				</div>
				<button type="submit" class="btn btn-primary">更新</button>
			</form>
		</div>
	</div>
</div>
@stop