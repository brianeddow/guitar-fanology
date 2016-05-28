<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use DateTime;
use App\Comment;
use Auth;

class CommentsController extends Controller
{
    public function create($post_id, Request $request)
    {
        $this->validate($request, [
            'body' => 'required|min:4'
        ]);

        $body = $request->input('body');
        DB::table('comments')->insert([
            'user_id' => Auth::user()->id,
            'body' => $body,
            'post_id' => $post_id
        ]);
        return back();
    }

    public function delete($comm_id, Request $request)
    {
        DB::table('comments')->where('id', $comm_id)->delete();
        return back();
    }
}
