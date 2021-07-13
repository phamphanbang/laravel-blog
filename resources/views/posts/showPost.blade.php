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
                        <a href="{{ url('/post/'.$data["post"]->id.'/edit') }}"
                            class="btn btn-secondary float-right">{{ __('Edit Post') }}</a>
                        @endif
                        @endauth
                    </div>
                    <p>
                        <?php 
                                $create_at = date_create($data["post"]->created_at);
                                $y = date_format($create_at, "M d/Y");
                                $x = date_format($create_at,"H:i A") ;
                                echo $y . __('at')  . $x;
                                ?>
                        {{ __('by') }}
                        <a
                            href="{{ route('profile',['id' => $data["post"]->author_id]) }}">{{ $data["post"]->user->name }}</a>
                    </p>
                </div>
                <div class="card-body">
                    {!! $data["post"]->body !!}
                    <label for="comment">
                        <h2>{{ __('Leave a comment') }}</h2>
                    </label>
                    @if (auth()->user())
                    <form action="{{ url('/comment') }}" method="POST">
                        <div class="form-group pl-4 pr-4">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="on_post"
                                value="{{ old('post_id') ? old('post_id') : $data["post"]->id }}">
                            <textarea class="form-control" id="body" name="body" rows="3"
                                placeholder="Enter comment here"></textarea>
                                <button type="submit" name="post" class="btn btn-success mt-4 ">{{ __('Post') }}</button>
                        </div>
                    </form>
                    @else
                    <p>{{ __('Login to Comment') }}</p>
                    @endif
                    @if ($data["comments"]->count() > 0)
                    @foreach ($data["comments"] as $comment)
                    <div class="card mt-4 mb-2">
                        <div class="card-header">
                            <div>
                                <h2>{{ $comment->user->name }}</h2>
                            </div>
                            <p>
                                <?php 
                                                $create_at = date_create($comment->created_at);
                                                $y = date_format($create_at, "M d/Y");
                                                $x = date_format($create_at,"H:i A") ;
                                                echo $y . " at " . $x;
                                                ?>
                            </p>
                        </div>
                        <div class="card-body">
                            {!! $comment->body !!}
                        </div>
                    </div>
                    @endforeach
                    {{ $data["comments"]->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection