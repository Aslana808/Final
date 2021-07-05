<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;

class UserPostController extends Controller
{
    public function index(User $user){
        $posts = $user->posts()->with(['user', 'likes'])->paginate(20);

        return view('users.index', [
            'user' => $user,
            'posts' => $posts
        ]);
    }
}
