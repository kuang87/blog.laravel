<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('posts', function (){
    $posts = \App\Post::paginate(5);
    return view('posts', ['posts' => $posts]);
});

Route::get('posts/tag/{tag}', function ($tag){
    dd ($tag);
})->name('tag_route');


Route::get('posts/{post}', function (\App\Post $post){
    dd ($post);
});

Route::get('user/{user}', function (\App\User $user){
    dd ($user->posts());
});