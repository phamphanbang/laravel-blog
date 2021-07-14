@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/posts/userProfile.css') }}">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-xl-10">
            <div class="card">
                <div class="card-header">
                    <h3> {{ $data["user"]->name }} </h3>
                </div>
                <div class="card-body">
                    @foreach ($data["posts"] as $post )


                    <div class="card mb-4">
                        <div class="card-header">
                            <div>
                                <a href="{{ route('showPost',['title' => $post->title]) }}">{{ $post->title }}</a>
                                @auth
                                @if (auth()->user()->role == 'admin' || auth()->user()->id == $post->author_id )
                                <a href="{{ route('editPost',['id' => $post->id]) }}"
                                    class="btn btn-secondary float-right">Edit Post</a>
                                @endif
                                @endauth </div>
                            <p><?php 
                                $create_at = date_create($post->created_at);
                                $y = date_format($create_at, "M d/Y");
                                $x = date_format($create_at,"H:i A") ;
                                echo $y . " at " . $x;
                                ?> by <a href="#">{{ $post->user->name }}</a></p>
                        </div>
                        <div class="card-body">
                            {!! $post->body !!}
                        </div>
                    </div>
                    @endforeach
                    {{ $data["posts"]->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection