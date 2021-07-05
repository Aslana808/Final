<?php

namespace App\Http\Controllers;

use App\Mail\PostLiked;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    public function index(){
        $user = auth()->user();
        $posts = $user->posts()->with(['user', 'likes'])->paginate(20);

        return view('users.index', [
            'user' => $user,
            'posts' => $posts
        ]);
    }
}
