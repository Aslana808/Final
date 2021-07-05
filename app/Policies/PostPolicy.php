<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    //ამოწმებს კონკრეტული პოპსტი დალოგინებულ იუზერს ეკუთვნის თუ არა, იმისთვის,
    // რომ იუზერებმა ერთმანეთის პოსტები ვერ წაშალონ
    public function delete(User $user, Post $post){
        return $user->id === $post->user_id;
    }
}
