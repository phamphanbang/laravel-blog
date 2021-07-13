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
                    <div class="card">
                        <div class="card-header">{{ __('Join on') }}<?php 
                            $create_at = date_create($data["user"]->created_at);
                            $y = date_format($create_at, "M d/Y");
                            $x = date_format($create_at,"H:i A") ;
                            echo $y .__('at'). $x;
                            ?></div>

                        <div class="card-body">
                            <div class="card-text">
                                <table>
                                    <tr>
                                        <td>{{ __('Total Posts') }}</td>
                                        <td>{{ $data["posts_count"] }}</td>
                                        @auth
                                        @if (auth()->user()->role == 'admin' || auth()->user()->id == $data['user']->id )
                                        <td><a href="{{ route('indexPost',['id' => $data['user']->id,'type' => "all"] ) }}">
                                            {{ __('Show all') }}</a></td>
                                        @endif
                                        @endauth

                                    </tr>
                                    <tr>
                                        <td>{{ __('Published Posts') }}</td>
                                        <td>{{ 
                                        $data["posts_public_count"] }}</td>
                                        <td><a
                                                href="{{ route('indexPost',['id' => $data['user']->id,'type' => "public" ] ) }}">
                                                {{ __('Show all') }}</a></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Posts in Draft') }}</td>
                                        <td>{{ $data["posts_draft_count"] }}</td>
                                        @auth
                                        @if (auth()->user()->role == 'admin' || auth()->user()->id == $data['user']->id )
                                        <td><a href="{{ route('indexPost',['id' => $data['user']->id,'type' => "draft" ]) }}">
                                            {{ __('Show all') }}</a></td>
                                        @endif
                                        @endauth
                                        
                                    </tr>
                                </table>
                            </div>

                        </div>
                        <div class="card-header">
                            {{ __('Total Comments') }} 0
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-header">
                            <h3>{{ __('Latest Post') }}</h3>
                        </div>

                        <div class="card-body">
                            <div class="card-text">
                                <table>
                                    @if ($data["posts_public_count"] > 0)
                                    @foreach ($data["posts_public"] as $post )
                                    <tr>
                                        <td><a href="{{ url('/post/'.$post->id) }}">{{ $post->title }}</a></td>
                                        <td>{{ __('Join on') }}<?php 
                                            $create_at = date_create($post->created_at);
                                            $y = date_format($create_at, "M d/Y");
                                            $x = date_format($create_at,"H:i A") ;
                                            echo $y . __('at') . $x;
                                            ?></td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td>{{ __('You dont have any post yet') }}</td>
                                    </tr>
                                    @endif
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-header">
                            <h3>Latest Comments</h3>
                        </div>
                        @if ($data["comments_count"] > 0)
                        @foreach ($data["comments"] as $comment)
                        <div class="card-body border-bottom">
                            <div class="card-text">
                                <p>{{ $comment->body }}</p>
                                <p>Join on <?php 
                                    $create_at = date_create($comment->created_at);
                                    $y = date_format($create_at, "M d/Y");
                                    $x = date_format($create_at,"H:i A") ;
                                    echo $y . " at " . $x;
                                    ?></p>
                                <p>
                                    {{ __('On post') }} <a
                                        href="{{ url('/post/'.$comment->post->id) }}">{{ $comment->post->title }}</a>
                                </p>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="card-body border-bottom">
                            <div class="card-text pl-4">
                                {{ __('You dont have any comment yet') }} 
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection