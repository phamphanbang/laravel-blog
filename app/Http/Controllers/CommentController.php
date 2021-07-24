<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    //
    public function store(Request $request)
    {
        
        $data["comment"] = new Comment;
        $data["comment"]->on_post = $request->on_post;
        $data["comment"]->from_user = $request->user()->id;
        $data["comment"]->body = $request->body;
        $data["comment"]->save();
        $data["comments"] = Comment::where('on_post',$request->on_post)->orderBy('created_at', 'desc')->paginate(2);
        $data["post"] = Post::where('id',$request->on_post)->first();
        return redirect('/post/'.$data["post"]->id)->with('data', $data);
    }
}
