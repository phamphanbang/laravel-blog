<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    public function create(Request $request)
    {
        if($request->session()->has('data')){
            $data['delete-message'] = $request->session()->get('data')['delete-message'];
            return view('posts.createPost')->with('data',$data);
        }
        return view('posts.createPost');
    }

    public function store(StorePostRequest $request)
    {
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
        $data["message"] = __('Store Success');
        return redirect('/post/'.$data["post"]->id.'/edit')->with('data',$data);
    }

    public function index(Request $request)
    {
        $data["user"] = User::find($request->id);
        if ($request->type == "public") {
            $data["posts"] = Post::where('public', 1)->author($request->id)->paginate(2);
        } elseif ($request->type == "draft") {
            $data["posts"] = Post::where('public', 0)->author($request->id)->paginate(2);
        } else {
            $data["posts"] = Post::author($request->id)->paginate(2);
        }

        return view('posts.indexPost')->with('data', $data);
    }

    public function edit(Request $request,$id)
    {
        if($request->session()->has('data')){
            $data["message"] = $request->session()->get('data')["message"];
        }
        $data["post"] = Post::find($id);
        return view('posts.editPost')->with('data',$data);
    }

    public function update(UpdatePostRequest $request,$id){
        $data["post"] = Post::find($id);
        $data["post"]->author_id = $request->author_id;
        $data["post"]->title = $request->title;
        $data["post"]->body = $request->body;
        if ($request->has("update")) {
            $data["post"]->public = 1;
        } else {
            $data["post"]->public = 0;
        }
        $data["post"]->update();
        $data["message"] = __('Update Success');
        return redirect('/post/'.$id.'/edit')->with('data',$data);
    }

    public function destroy(Request $request,$id){
        $data["post"] = Post::find($id);
        $data["post"]->delete();
        $data["delete-message"] = __('Delete success');
        return redirect('/post/create')->with('data',$data);
    }

    public function show(Request $request,$id)
    {
        $data["post"] = Post::find($id);
        $data["comments"] = Comment::where('on_post',$id)->paginate(2);
        return view('posts.showPost')->with('data', $data);
    }
}
