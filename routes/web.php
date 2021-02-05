<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;


Route::get('/dashboard',[DashboardController::class,'dashboard'])
->name('dashboard');
//->middleware('auth');

Route::get('/home',[DashboardController::class,'home'])->name('home');

Route::get('/login',[LoginController::class, 'new'])->name('login');
Route::post('/login',[LoginController::class, 'create']);
Route::post('/logout',[LoginController::class, 'delete'])->name('logout');

Route::get('/register',[RegisterController::class, 'index'])->name('register');
Route::post('/register',[RegisterController::class, 'create']);//->name('register'); //inherits

Route::get('/posts',[PostController::class, 'index'])->name('posts');
Route::post('/post',[PostController::class, 'create'])->name('post');

/*
Route::get('/posts', function(){
	return view('posts.index');
});
*/