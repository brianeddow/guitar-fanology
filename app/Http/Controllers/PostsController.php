<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use DateTime;
use App\Post;
use App\Guitar;
use Auth;

class PostsController extends Controller
{
    public function create($guitar_id, Request $request)
    {
        $this->validate($request, [
            'body' => 'required|min:4'
        ]);

        $body = $request->input('body');
        DB::table('posts')->insert([
            'user_id' => Auth::user()->id,
            'guitar_id' => $guitar_id,
            'body' => $body,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ]);
        return back();
    }

    public function delete($post_id, Request $request)
    {
        DB::table('posts')->where('id', $post_id)->delete();
        return back();
    }
}
