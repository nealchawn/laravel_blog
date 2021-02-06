<!-- Order your soul. Reduce your wants. - Augustine -->
<!-- delete Post.php view component @props(['post' => $post])-->

<div class="mb-4">
	<a href="{{route('user_posts', $post->user)}}" class="font-bold">{{$post->user->name}}</a> <span class="text-gray-600 text-sm">{{$post->created_at->diffForHumans()}}</span>
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

		@can('delete', $post)
			<form action="{{route('delete_post',$post)}}" method="post" >
				 @csrf
				 @method('DELETE')
				 <button type="submit" class="text-blue-500">Delete</button>
			</form>
		@endcan

	@endauth
	
	<span>&nbsp;&nbsp;{{$post->likes->count()}} {{Str::plural('like',$post->likes->count())}} </span>
</div>