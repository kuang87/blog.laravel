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
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::middleware('auth')->group(function (){
    Route::get('admin/dashboard', function (){
        return view('admin/dashboard');
    })->name('adm.dashboard');

    Route::prefix('admin/categories')->group(function (){
        Route::get('/', 'CategoryController@index')->name('category.index');
        Route::get('create', 'CategoryController@create')->name('category.create');
        Route::post('/', 'CategoryController@store')->name('category.store');
        Route::get('{category}', 'CategoryController@show')->name('category.show');
        Route::get('{category}/edit', 'CategoryController@edit')->name('category.edit');
        Route::put('{category}', 'CategoryController@update')->name('category.update');
        Route::delete('{category}', 'CategoryController@destroy')->name('category.destroy');
    });

    Route::prefix('admin/posts')->group(function (){
        Route::get('/', 'PostController@index')->name('post.index');
        Route::get('create', 'PostController@create')->name('post.create');
        Route::post('/', 'PostController@store')->name('post.store');
        Route::get('{post}', 'PostController@show')->name('post.show');
        Route::get('{post}/edit', 'PostController@edit')->name('post.edit');
        Route::put('{post}', 'PostController@update')->name('post.update');
        Route::delete('{post}', 'PostController@destroy')->name('post.destroy');
    });

    Route::prefix('admin/tags')->group(function (){
        Route::get('/', 'TagController@index')->name('tag.index');
        Route::get('create', 'TagController@create')->name('tag.create');
        Route::post('/', 'TagController@store')->name('tag.store');
        Route::get('{tag}', 'TagController@show')->name('tag.show');
        Route::get('{tag}/edit', 'TagController@edit')->name('tag.edit');
        Route::put('{tag}', 'TagController@update')->name('tag.update');
        Route::delete('{tag}', 'TagController@destroy')->name('tag.destroy');
    });
});