@extends('layouts.application')
@section('title','Posts')

@section('content')
	<div class="flex justify-center">
		<div class="w-8/12 bg-white p-6 rounded-lg">
			Posts

			<hr class="p-2">

			<form action="{{route('post')}}" method="post">
				@csrf
				<div class="mb-4">
					<label for="body" class="sr-only">Body</label>
					<textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror" placeholder="Post about something!" ></textarea>

					@error('body')
						<div class="text-red-500 mt-2 text-sm">
							{{ $message }}
						</div>
					@enderror
				</div>
				<div>
					<button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Post</button>
				</div>
			</form>

			@if($posts->count())
				@foreach( $posts as $post)
					<div class="mb-4">
						<a href="" class="font-bold">{{$post->user->name}}</a> <span class="text-gray-600 text-sm">{{$post->created_at->diffForHumans()}}</span>
						<p class="mb-2"></p>
						{{$post->body}}
					</div>

					<div class="flex items-center">
						@auth
							@if(!($post->liked_by(auth()->user())))
								<form action="{{route('post_rating', $post->id)}}" method="post" class="mr-1">
									@csrf
									<input type="text" name="status" value="like" hidden>
									<button type="submit" class="text-blue-500">Like</button>
								</form>
							@else
								<form action="{{route('post_rating', $post)}}" method="post" class="mr-1">
									@csrf
									@method('DELETE')
									<input type="text" name="status" value="unlike" hidden>
									<button type="submit" class="text-blue-500">Unlike</button>
								</form>
							@endif
						@endauth
						<span>{{$post->likes->count()}} {{Str::plural('like',$post->likes->count())}} </span>
					</div>

				@endforeach
				{{ $posts->links() }}
			@else
				<p> There are no posts.</p>
			@endif
		</div>
	</div>
@endsection