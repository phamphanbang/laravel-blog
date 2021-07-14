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
                    <div>
                        <h2>{{ $data["post"]->title }}</h2>
                        @auth
                        @if (auth()->user()->id == $data["post"]->author_id )
<<<<<<< HEAD
                        <a href="{{ route('editPost',['id' => $data["post"]->id]) }}"
                            class="btn btn-secondary float-right">Edit Post</a>
=======
                        <a href="{{ url('/post/'.$data["post"]->id.'/edit') }}"
                            class="btn btn-secondary float-right">{{ __('Edit Post') }}</a>
>>>>>>> 8cc1e8e (add crud for post)
                        @endif
                        @endauth
                    </div>
                    <p>
                        <?php 
                                $create_at = date_create($data["post"]->created_at);
                                $y = date_format($create_at, "M d/Y");
                                $x = date_format($create_at,"H:i A") ;
<<<<<<< HEAD
                                echo $y . " at " . $x;
                                ?>
                        by
                        <a
                            href="{{ route('profile',['id' => $data["post"]->author_id]) }}">{{ $data["post"]->user->name }}</a>
=======
                                echo $y . __('at')  . $x;
                                ?>
                        {{ __('by') }}
                        <a
                            href="#">{{ $data["post"]->user->name }}</a>
>>>>>>> 8cc1e8e (add crud for post)
                    </p>
                </div>
                <div class="card-body">
                    {!! $data["post"]->body !!}
                    <label for="comment">
<<<<<<< HEAD
                        <h2>Leave a comment</h2>
=======
                        <h2>{{ __('Leave a comment') }}</h2>
>>>>>>> 8cc1e8e (add crud for post)
                    </label>
                    @if (auth()->user())
                    <form action="" method="POST">

                        <div class="form-group pl-4 pr-4">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="on_post"
                                value="{{ old('post_id') ? old('post_id') : $data["post"]->id }}">
                            <textarea class="form-control" id="body" name="body" rows="3"
                                placeholder="Enter comment here"></textarea>
<<<<<<< HEAD
                            <button type="button" name="post" class="btn btn-success mt-4 ">Post</button>
                        </div>
                    </form>
                    @else
                    <p>Login to Comment</p>
=======
                            <button type="button" name="post" class="btn btn-success mt-4 ">{{ __('Post') }}</button>
                        </div>
                    </form>
                    @else
                    <p>{{ __('Login to Comment') }}</p>
>>>>>>> 8cc1e8e (add crud for post)
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection