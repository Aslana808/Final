<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        //eager loading(less queries are executed)
        $posts = Post::latest()->with(['user','likes'])->paginate(20);
        return view('posts.index', [ // compact ფუნქცია ვერ გამოვიყენე ერორს მიგდებდა
            'posts' => $posts
        ]);
    }

    public function post(PostRequest $request){

        $request->user()->posts()->create([
            'body' => $request->get('body')
        ]);
        return redirect()->back();
    }

    public function destroy(Post $post){
        //ჩვენს მიერ შექმნილი policy - ის მიხედვით გვაქვს თუ არა პოსტის წაშლის უფლება
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->back();
    }
}
