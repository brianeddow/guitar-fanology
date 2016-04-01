<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;
use App\Guitar;
use App\User;

class Post extends Model
{
    protected $fillable = ['body']; // $guitar->addPost(new Post(['body' => $request->all()]));

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function guitar()
    {
        return $this->belongsTo(Guitar::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function add_comment($comment)
    {
        return $this->comments()->save($comment);
    }

}
