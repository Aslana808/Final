<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        return Post::all();
    }

    public function create(PostRequest $request){
//        $post = Post::create([
//            //'user_id' => $request->get('user_id'),
//            'body' => $request->get('body')
//        ]);
        $request->user()->posts()->create([
            'body' => $request->get('body')
        ]);
        return response(['message' => 'successfully posted!']);
    }
}
