<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
	public function index(){
		// eloquent methods on model
		$posts = Post::get();//::where ::find

		return view('posts.index', [
			'posts' => $posts
		]);
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
}