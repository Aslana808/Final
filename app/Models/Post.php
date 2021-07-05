<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'body'
    ];

    //ამოწმებს კონკრეტულ იუზერს უკვე დალაიქებული აქვს თუ არა პოსტი, ერთმა იუზერმა ბევრჯერ რომ არ დაალაიქოს პოსტი
    public function likedBy(User $user){
        //ამოწმებს კონკრეტული იუზერის აიდი თუ ემთხვევა ლაიკების ბაზაში იუზერის აიდის
        return $this->likes->contains('user_id', $user->id);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function likes(){
        return $this->hasMany(Like::class);
    }
}
