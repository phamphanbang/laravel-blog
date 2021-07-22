<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');
Auth::routes();

Route::middleware(['auth'])->group(function (){
    Route::post('/post/create', ['as' => 'createPost','uses' => 'PostController@store']);
    Route::get('/post/{id}/edit', ['as' => 'editPost','uses' => 'PostController@edit']);
    Route::post('/post/update', ['as' => 'updatePost','uses' => 'PostController@update']);
    Route::get('post/{id}/delete',['as' => 'deletePost','uses' => 'PostController@destroy'] );
    Route::get('/post/create', 'PostController@create');
});

Route::get('/home', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::get('/user/{id}/posts/{type}',['as' => 'indexPost','uses' => 'PostController@index']);
Route::get('/posts/{title}',['as' => 'showPost','uses' => 'PostController@show']);
