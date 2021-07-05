<?php

namespace App\Http\Controllers;

use App\Mail\PostLiked;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PostLikeController extends Controller
{
    public function like(Request $request, $id){
        $post = Post::find($id);
        if($post->likedBy($request->user())){
            return response(null, 409);
        }
        $post->likes()->create([
            'user_id' => $request->user()->id,
        ]);

        //only send this mail if it has not been previously liked
        if(!$post->likes()->onlyTrashed()->where('user_id', $request->user()->id)->count()){
            Mail::to($post->user)->send(new PostLiked(auth()->user(), $post));
        }

        return redirect()->back();
    }
    public function dislike(Request $request, $id){
        $request->user()->likes()->where('post_id', $id)->delete();
        return redirect()->back();
    }
}
