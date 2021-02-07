<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Mail;
use App\Mail\PostLiked;

class PostRatingController extends Controller
{

	public function __construct(){
		$this->middleware(['auth']);
	}

	public function create(Post $post, Request $request){
		//$post = Post::find($id);
		// $post->likes()->withTrashed()->get() // onlyTrashed
    	if($post->liked_by($request->user())){
    		return response(null, 409); // conflict
    	}

		$post->likes()->create([
			'user_id' => $request->user()->id,
			'status' => 'like' // $request->status
		]);

		if(!($post->likes()->onlyTrashed()->where('user_id',$request->user()->id)->count())){
			Mail::to($post->user)->send(new PostLiked(auth()->user(), $post));
		}
		
		return back();
	}

	public function destroy(Post $post, Request $request){
		//dd($request);
		$request->user()->likes()->where('post_id', $post->id)->delete();
		return back();
	}
}
