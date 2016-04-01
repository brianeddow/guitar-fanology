<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use DateTime;
use App\Post;
use App\Comment;
use App\Guitar;
use Auth;

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
        DB::table('guitars')->insert(['name' => $name, 'model' => $model, 'notes' => $notes, 'created_at' => new DateTime, 'updated_at' => new DateTime]);
        return back();
    }

    public function show($id, Guitar $guitar)
    {
        $guitar = DB::table('guitars')->where(['id' => $id])->first();
        $guitar->posts = Post::where(['guitar_id' => $id])->get();
        $guitar->comments = DB::table('users')->join('comments', 'users.id', '=', 'comments.user_id')->get();
        // $guitar->comments = Comment::get();
        return view('show', compact('guitar'));
    }

    public function edit($id)
    {
        $guitar = DB::table('guitars')->where(['id' => $id])->first();
        return view('edit')->with(['guitar' => $guitar]);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'model' => 'required|min:3',
            'notes' => 'required|min:10'
        ]);

        $name = $request->input('name');
        $model = $request->input('model');
        $notes = $request->input('notes');
        DB::table('guitars')->where('id', $id)->update(['name' => $name, 'model' => $model, 'notes' => $notes]);
        return redirect('guitars');
    }

    public function remove($id)
    {
        $guitar = DB::table('guitars')->where(['id' => $id])->first();
        return view('remove', compact('guitar'));
    }

    public function destroy($id)
    {
        DB::table('guitars')->where('id', $id)->delete();
        return redirect('guitars');
    }

    public function like($guitar_id)
    {
        DB::table('likes')->insert(['user_id' => Auth::user()->id, 'guitar_id' => $guitar_id]);
        return back();
    }

    public function unlike($guitar_id)
    {
        DB::table('likes')->where(['user_id' => Auth::user()->id, 'guitar_id' => $guitar_id])->delete();
        return back();
    }
}
