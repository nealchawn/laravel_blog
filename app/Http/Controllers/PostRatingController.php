<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostRatingController extends Controller
{

	public function __construct(){
		$this->middleware(['auth']);
	}

	public function create(Post $post, Request $request){
		//$post = Post::find($id);
    	if($post->liked_by($request->user())){
    		return response(null, 409); // conflict
    	}

		$post->likes()->create([
			'user_id' => $request->user()->id,
			'status' => 'like' // $request->status
		]);
		
		return back();
	}

	public function destroy(Post $post, Request $request){
		//dd($request);
		$request->user()->likes()->where('post_id', $post->id)->delete();
		return back();
	}
}
