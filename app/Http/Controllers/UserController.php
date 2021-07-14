<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{


    public function show($id )
    {
        $data["user"] = User::find($id);
        $data["posts"] = $data["user"]->posts;
        $data["posts_count"] = $data["posts"]->count();
        $data["posts_public"] = $data["posts"]->where('public',1)->take(3);
        $data["posts_public_count"] = $data["posts"]->where('public',1)->count();
        $data["posts_draft"] = $data["posts"]->where('public',0);
        $data["posts_draft_count"] = $data["posts_draft"]->count();
        return view('userProfile')->with('data',$data);
    }
}
