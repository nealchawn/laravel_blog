<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
	public function __construct(){
		$this->middleware(['auth'])->only(['create','delete']);
	}

	public function index(){
		// eloquent methods on model latest()
		$posts = Post::orderBy('created_at','desc')->with(['user','likes'])->paginate(5);//::get ::where ::find

		return view('posts.index', [
			'posts' => $posts
		]);
	}

	public function show(Post $post){
		return view('posts.show', ['post'=>$post]);
	}

	public function create(Request $request){
		//dd('ok');
		$this->validate($request, [
			'body' => 'required',
		]);

		auth()->user()->posts()->create($request->only('body'));
		
		return back();
		/**
		$request->user(); // yaw--get user

		Post::create([
			'user_id' => auth()->user()->id,
			'body' => $request->body
		]);
		// requires adding user_id to fillable
		**/

	}

	public function destroy(Post $post, Request $request){
		/*
		if($post->owned_by(auth()->user())){
			$post->delete();
		}
		*/
		$this->authorize('delete', $post);
		$post->delete();

		return back();
	}
}