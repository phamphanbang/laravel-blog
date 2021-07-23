@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>{{ __('Latest Post') }}</h2>
                </div>

                <div class="card-body">
                    @foreach ($data["posts"] as $post )
                    <div class="card mb-4">
                        <div class="card-header">
                            <div>
                                <a href="{{ url('/post/'.$post->id) }}">{{ $post->title }}</a>
                                @auth
                                @if (auth()->user()->role == 'admin' || auth()->user()->id == $post->author_id )
                                <a href="{{ url('/post/'.$post->id.'/edit') }}"
                                    class="btn btn-secondary float-right">{{ __('Edit Post') }}</a>
                                @endif
                                @endauth

                            </div>
                            <p><?php 
                                $create_at = date_create($post->created_at);
                                $y = date_format($create_at, "M d/Y");
                                $x = date_format($create_at,"H:i A") ;
                                echo $y . __('at') . $x;
                                ?> {{ __('by') }} <a
                                    href="#">{{ $post->user->name }}</a>
                            </p>
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
@endsection
