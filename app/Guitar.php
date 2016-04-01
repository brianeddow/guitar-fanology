<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

class Guitar extends Model
{
    protected $fillable = ['body'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function add_post(Post $post)
    {
        return $this->posts()->save($post);
    }
}
