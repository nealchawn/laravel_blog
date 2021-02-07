<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\PostLiked;


class DashboardController extends Controller
{
	public function __construct(){
		$this->middleware(['auth'])->except('home');
	}
    //
    public function dashboard(){
    	// $user = auth()->user();

    	//dd(auth()->user()->posts[0]->likes);
    	return view('dashboard');
    }
    public function home(){
    	//$user = auth()->user();
    	//dd($user);
    	return view('home');
    }
}
