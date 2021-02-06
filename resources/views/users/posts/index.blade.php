@extends('layouts.application')
@section('title','User Posts')

@section('content')
	<div class="flex justify-center">
		<div class="w-8/12 bg-white p-6 rounded-lg">
			{{$user->name}}'s Posts

			<hr class="p-2">
			@if($posts->count())
				@foreach( $posts as $post)
					<x-post :post="$post" />
				@endforeach
				{{ $posts->links() }}
			@else
				{{$post->user}} has no posts.
			@endif
		</div>
	</div>
@endsection