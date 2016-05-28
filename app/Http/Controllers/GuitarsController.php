<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Post;
use App\Comment;
use App\Guitar;
use Auth;
use DateTime;

class GuitarsController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'model' => 'required',
            'notes' => 'required'
        ]);

        $name = $request->input('name');
        $model = $request->input('model');
        $notes = $request->input('notes');
        DB::table('guitars')->insert([
            'name' => $name,
            'model' => $model,
            'notes' => $notes,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ]);
        return back();
    }

    public function show($id)
    {
        $guitar = DB::table('guitars')->where(['id' => $id])->first();
        $guitar->posts = Post::where(['guitar_id' => $id])->get();
        $guitar->comments = DB::table('users')->join('comments', 'users.id', '=', 'comments.user_id')->get();
        $guitar->other_users = DB::table('users')->join('likes', 'users.id', '=', 'likes.user_id')->join('guitars', 'likes.guitar_id', '=', 'guitars.id')->where('guitars.id', '=', $id)->where('likes.user_id', '!=', Auth::user()->id)->select('users.email')->take(3)->get();
        $guitar->auth_id = Auth::user()->id;
        $guitar->fanologists = count(DB::table('users')->get());
        $other_users_arr = [];
        foreach ($guitar->other_users as $user)
        {
            array_push($other_users_arr, $user);
        }

        $guitar->other_users_count = count($other_users_arr);
        // var_dump($guitar->other_users_count); die();
        // var_dump($guitar->other_users); die();
        return view('show', compact('guitar'));
    }

    public function edit($id)
    {
        $guitar = DB::table('guitars')->where(['id' => $id])->first();
        $notes = DB::table('edit_guitar_notes_request')->leftJoin('edit_guitar_notes_request_likes', 'edit_guitar_notes_request.note_id', '=', 'edit_guitar_notes_request_likes.like_id')->where(['guitar_id' => $id])->orderBy('edit_guitar_notes_request_likes.count', 'desc')->get();
        $fanologists = count(DB::table('users')->get());
        // $likes = DB::table('edit_guitar_notes_request_likes')->get();
        // var_dump($likes); die();
        return view('edit')->with(['guitar' => $guitar, 'notes' => $notes, 'fanologists' => $fanologists]);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'notes' => 'required|min:10'
        ]);

        $notes = $request->input('notes');

        DB::table('edit_guitar_notes_request')->insert([
            'guitar_id' => $id,
            'user_id' => Auth::user()->id,
            'notes' => $notes,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ]);

        $note = DB::table('edit_guitar_notes_request')->orderBy('created_at', 'desc')->first();
        // var_dump($note->note_id); die();

        DB::table('edit_guitar_notes_request_likes')->insert([
            'edit_guitar_notes_request_id' => $note->note_id,
            'count' => 0
        ]);
        return redirect('/guitars/'.$id.'/edit');
    }

    public function remove($id)
    {
        $guitar = DB::table('guitars')->where(['id' => $id])->first();
        $guitar->fanologists = count(DB::table('users')->get());
        return view('remove', compact('guitar'));
    }

    public function destroy($id)
    {
        DB::table('guitars')->where('id', $id)->delete();
        return redirect('guitars');
    }

    public function like($guitar_id)
    {
        DB::table('likes')->insert([
            'user_id' => Auth::user()->id,
            'guitar_id' => $guitar_id
        ]);
        return back();
    }

    public function unlike($guitar_id)
    {
        DB::table('likes')->where([
            'user_id' => Auth::user()->id,
            'guitar_id' => $guitar_id
        ])->delete();
        return back();
    }

    public function like_note($note_id)
    {
        $like = DB::table('edit_guitar_notes_request_likes')->where(['edit_guitar_notes_request_id' => $note_id])->first();
        // var_dump($like->count); die();
        $like->count += 1;
        DB::table('edit_guitar_notes_request_likes')->where(['like_id' => $like->like_id])->update(['count' => $like->count]);
        return back();
    }

}
