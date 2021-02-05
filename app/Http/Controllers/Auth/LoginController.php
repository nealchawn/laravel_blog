<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct(){
        $this->middleware(['guest'])->except('delete'); // needs to flash error if unauthorized
    }

    public function new(){
    	return view('auth.login');
    }

    public function create(Request $request){

    	$this->validate($request, [
    		'email' => ['required', 'email'], // may not want this 'exists:users'
    		'password' => ['required'], // looks for _confirmation
    	]);

    	auth()->attempt($request->only('email','password'), $request->remember);
    	if (auth()->user())
    		return redirect()->route('dashboard');
    	else
    		return redirect()->back()->with('status','Invalid login details');
    }

    public function delete(){
    	auth()->logout();
    	return redirect()->route('home');
    }
}
