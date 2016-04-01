<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Auth;

class PagesController extends Controller
{
    public function index()
    {
        $guitars = DB::table('guitars')->get();
        $likes = DB::table('users')->join('likes', 'users.id', '=', 'likes.user_id')->join('guitars', 'likes.guitar_id', '=', 'guitars.id')->where('users.id', '=', Auth::user()->id)->get();
        return view('main')->with(['guitars' => $guitars, 'likes' => $likes]);
    }
}
