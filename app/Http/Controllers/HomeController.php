<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


class HomeController extends Controller
{
    public function index()
    {
        $data["posts"] = Post::where('public',1)->orderBy('created_at', 'desc')->paginate(2);
        return view('home')->with('data',$data);

    }
}
