<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
    	return view('auth.register');
    }

    public function create(Request $request){
    	// dd($request); shut down and print $variable die dump
    	$this->validate($request, [
    		'name' => ['required', 'max:255|unique:users'],
    		'username' => 'required|max:255|unique:users',
    		'email' => ['required', 'max:255|unique:users', 'email'],
    		'password' => ['required', 'confirmed'], // looks for _confirmation
    	]); // throw exception and redirect with error info

    	User::create([
    		'name' => $request->name,
    		'username' => $request->username,
    		'email' => $request->email,
    		'password' => Hash::make($request->password) // facade in laravel Hash 
    	]);

    	// sign_in
    	// Auth from facade or auth helper: auth()->user();
    	/* Alt
    	auth()->attempt([
    		'email'-> $request->email,
    		'password'->$request->password
    	]);

    	returns an auth()->user();
    	*/ 

    	auth()->attempt($request->only('email','password')); // could use above if not for pass hash
 
    	return redirect()->route('dashboard');  // redirect('/dashboard');
    }
}
