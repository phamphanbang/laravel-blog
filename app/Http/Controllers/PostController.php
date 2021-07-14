<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function create(Request $request)
    {
       
        return view('posts.createPost');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts,title,'.$request->title.',title',
            'body' => 'required',
        ] ,
        [
            'required' => 'The :attribute field is required.',
            'unique' => 'The :attribute has already exist'
        ]);
        
        if($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        $data["post"] = new Post;
        $data["post"]->author_id = $request->user()->id;
        $data["post"]->title = $request->title;
        $data["post"]->body = $request->body;
        if ($request->has("publish")) {
            $data["post"]->public = 1;
        } else {
            $data["post"]->public = 0;
        }
        $data["post"]->save();
        $data["message"] = "Success";
        return view('posts.editPost')->with('data',$data);
    }

    public function index(Request $request)
    {
        $data["user"] = User::find($request->id);
        if ($request->type == "public") {
            $data["posts"] = Post::where('public', 1)->where('author_id',$request->id)->orderBy('created_at', 'desc')->paginate(2);
        } elseif ($request->type == "draft") {
            $data["posts"] = Post::where('public', 0)->where('author_id',$request->id)->orderBy('created_at', 'desc')->paginate(2);
        } else {
            $data["posts"] = Post::where('author_id',$request->id)->orderBy('created_at', 'desc')->paginate(2);
        }

        return view('posts.indexPost')->with('data', $data);
    }

    public function edit(Request $request)
    {
        $data["post"] = Post::find($request->id);
        return view('posts.editPost')->with('data',$data);
    }

    public function update(Request $request){
        $data["post"] = Post::find($request->post_id);
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts,title,'.$data["post"]->title.',title',
            'body' => 'required',
        ] ,
        [
            'required' => 'The :attribute field is required.',
            'unique' => 'The :attribute has already exist'
        ]);
        
        if($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        
        $data["post"]->author_id = $request->author_id;
        $data["post"]->title = $request->title;
        $data["post"]->body = $request->body;
        if ($request->has("update")) {
            $data["post"]->public = 1;
        } else {
            $data["post"]->public = 0;
        }
        $data["post"]->update();
        $data["message"] = "Success";
        return view('posts.editPost')->with('data',$data);
    }

    public function destroy(Request $request){
        $data["post"] = Post::find($request->id);
        $data["post"]->delete();
        $data["delete-message"] = "Delete success";
        return view('posts.createPost')->with('data',$data);
    }

    public function show(Request $request)
    {
        $data["post"] = Post::where('title',$request->title)->first();
        return view('posts.showPost')->with('data', $data);
    }
}
