<section class="status">
	@if ($status_items->count() > 0)
		<ul class="list-unstyled">
			@foreach ($status_items as $status)
				@include('users._status',['user'=> $status->user])
			@endforeach
		</ul>
		<div class="mt-5">
			{!! $status_items->links() !!}
		</div>
	@else
		<p>还没有微博！</p>
	@endif
</section>