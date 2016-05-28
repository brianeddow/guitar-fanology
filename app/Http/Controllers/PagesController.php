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
        if(!Auth::user())
        {
            return redirect('/login');
        }
        else
        {
            $guitars = DB::table('guitars')->get();
            $guitar_imgs = DB::table('guitars')->groupBy('name')->get();
            $likes = DB::table('users')->join('likes', 'users.id', '=', 'likes.user_id')->join('guitars', 'likes.guitar_id', '=', 'guitars.id')->where('users.id', '=', Auth::user()->id)->get();
            $fanologists = count(DB::table('users')->get());
            $lines = array(
                'What tuning do you play in?',
                'Do you prefer nylon or steel strings?',
                'To whammy or not to whammy?',
                'Bridge or neck pickup.. Which do you prefer?',
                'Is a locking nut necessary?',
                'Do you prefer thin and flexible or thick picks?'
            );
            $tagline = $lines[rand(0,count($lines)-1)];

            return view('main')->with([
                'guitars' => $guitars,
                'likes' => $likes,
                'guitar_imgs' => $guitar_imgs,
                'tagline' => $tagline,
                'fanologists' => $fanologists
            ]);
        }
    }
}
