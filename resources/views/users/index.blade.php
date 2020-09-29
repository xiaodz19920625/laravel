@extends('layouts.default')
@section('title','用户列表')
@section('content')
	<div class="row">
		<div class="offset-md-2 col-md-8">
			<h2 class="mb-4 text-center">用户列表</h2>
			<div class="list-group list-group-flush">
				@foreach ($users as $user)
					<div class="list-group-item">
						<img src="{{$user->avatar}}" width="100" alt="{{$user->name}}" class="mr-3">
						<a href="{{ route('users.show', $user) }}">{{$user->name}}</a>
						@can('destroy', $user)
							<form method="post" action="{{ route('users.destroy', $user->id) }}" class="float-right">
								{{ method_field('DELETE') }}
								{{ csrf_field() }}
								<button type="submit" class="btn btn-sm btn-danger delete-on">删除</button>
							</form>
						@endcan
					</div>
				@endforeach
			</div>
			<div class="mt-3">
				{!! $users->links() !!}
			</div>
		</div>
	</div>
@stop