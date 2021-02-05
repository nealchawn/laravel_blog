<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
	public function __construct(){
		$this->middleware(['auth'])->except('home');
	}
    //
    public function dashboard(){
    	//$user = auth()->user();
    	dd(auth()->user()->posts[0]->user->name);
    	return view('dashboard');
    }
    public function home(){
    	//$user = auth()->user();
    	//dd($user);
    	return view('home');
    }
}
