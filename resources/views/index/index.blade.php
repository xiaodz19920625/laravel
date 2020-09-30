@extends('layouts.default')
@section('title','首页')
@section('content')
	@if (Auth::check())
		<div class="row">
			<div class="col-md-8">
				<section class="status_form">
					@include('users._status_create')
				</section>
			</div>
			<aside class="col-md-4">
				<section class="user_info">
					@include('users._user_info',['user'=> Auth::user()])
				</section>
			</aside>
		</div>
	@else
		<h1>首页</h1>
	@endif
@stop