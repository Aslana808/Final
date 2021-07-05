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

Route::get('/', function () {
    return view('home');
})->name('home');


//Register(middleware('guest) checks if we are already signed in and if so
// it does not allow us to go to register page and redirects to home page)
Route::get('/register', [\App\Http\Controllers\auth\RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register', [\App\Http\Controllers\auth\RegisterController::class, 'register']);

//login
Route::get('/login', [\App\Http\Controllers\auth\LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [\App\Http\Controllers\auth\LoginController::class, 'login']);

//logout
Route::get('/logout', [\App\Http\Controllers\auth\LogoutController::class, 'logout'])->name('logout');

//only for users who are logged in
Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

//url-ში id ის მაგივრად username ჩაჯდება
Route::get('/users/{user:username}/posts', [\App\Http\Controllers\UserPostController::class, 'index'])->name('users.posts');

Route::get('/posts', [\App\Http\Controllers\PostController::class, 'index'])->name('posts');
Route::post('/posts', [\App\Http\Controllers\PostController::class, 'post']);
Route::delete('/posts/{post}', [\App\Http\Controllers\PostController::class, 'destroy'])->name('posts.destroy');

//like
Route::post('/posts/{id}/like', [\App\Http\Controllers\PostLikeController::class, 'like'])->name('posts.like')->middleware('auth');
Route::delete('/posts/{id}/like', [\App\Http\Controllers\PostLikeController::class, 'dislike'])->name('posts.like')->middleware('auth');
