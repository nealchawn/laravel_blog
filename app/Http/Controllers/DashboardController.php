<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function dashboard(){
    	//$user = auth()->user();
    	//dd($user);
    	return view('dashboard');
    }
    public function home(){
    	//$user = auth()->user();
    	//dd($user);
    	return view('home');
    }
}
