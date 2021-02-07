@extends('layouts.application')
@section('title','User Posts')

@section('content')
	<div class="flex justify-center">
		<div class="w-8/12">
			<div class="p-6">
				<h1 class="text-2xl font-medium mb-1">{{$user->name}}'s Posts</h1>
				<p>Posted {{$posts->count()}} {{Str::plural('post', $posts->count())}}&nbsp;and&nbsp; received {{$user->received_likes()->count()}} {{Str::plural('like', $user->received_likes()->count())}}</p>
			</div>
			<div class="bg-white p-6 rounded-lg">

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

	</div>
@endsection