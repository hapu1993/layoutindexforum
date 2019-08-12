<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('posttags','posttags.tags','user')->get();
        $tags = Tag::with('posttags','posttags.posts')->get();
        // dd($posts);
        return view('home',compact('posts','tags'));
    }
}
