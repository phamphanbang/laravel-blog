<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', 'HomeController@index');
Auth::routes();

Route::middleware(['auth'])->group(function (){
    Route::resource('comment', CommentController::class);
    Route::resource('post', PostController::class);
});
Route::resource('post', PostController::class)->only('show');
Route::get('/home', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::get('/user/{id}/posts/{type}',['as' => 'indexPost','uses' => 'PostController@index']);
Route::get('/user/{id}',['as' => 'profile','uses' => 'UserController@show']);
