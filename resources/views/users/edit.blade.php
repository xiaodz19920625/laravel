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
			<div class="avatar_edit">
				<img src="{{$user->avatar}}" alt="{{$user->name}}" class="avatar" width="150">
			</div>
			<form method="POST" action="{{ route('users.update',$user->id) }}" enctype="multipart/form-data" >
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
				<div class="form-group">
					<label for="avatar" class="avatar-label">用户头像：</label>
					<input type="file" class="form-control-file" name="avatar"></input>
					@if ($user->avatar)
						<img src="{{ $user->avatar }}" class="thumbnail img-responsive" width="100"></img>
					@endif
				</div>
				<button type="submit" class="btn btn-primary">更新</button>
			</form>
		</div>
	</div>
</div>
@stop