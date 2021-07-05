<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//ვარეგისტრირებ იუზერს
Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);

//ვალოგინებ იუზერს და ენიჭება ტოკენი
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

//დალოგინების შედეგად მინიჭებული ტოკენის გამოყენებით თუ ავტორიზებულია იუზერი გამომაქვს პოსტები
Route::prefix('posts')->middleware('auth:api')->group(function (){
    Route::get('/', [\App\Http\Controllers\Api\PostController::class, 'index']);
    Route::post('/create', [\App\Http\Controllers\Api\PostController::class, 'create']);
});
