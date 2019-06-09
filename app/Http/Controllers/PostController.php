<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/post/index', ['posts' => Post::latest()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin/post/form', [
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:posts',
            'content' => 'alpha_dash',
            'slug' => 'required|unique:posts|max:255',
            'tag' => 'required',
        ]);

        $data = $request->post();

        $post = new Post();
        $post->title = $data['title'];
        $post->slug = $data['slug'];
        $post->thumbnail = 'https://lorempixel.com/640/480/?48341';
        $post->content = $data['content'];
        $post->category_id = $data['category'];
        $post->user_id = Auth::user()->id;
        $post->save();

        $post->tags()->sync($data['tag']);

        return redirect()->route('post.index')->with('message', 'Пост ' . $data['title'] . ' создан');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin/post/form', [
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|unique:posts,title,' . $post->id . ',id',
            'slug' => 'required|unique:posts,slug,' . $post->id . ',id|max:255',
            'content' => 'alpha_dash',
            'tag' => 'required',
        ]);

        $post->title = $data['title'];
        $post->slug = $data['slug'];
        $post->content = $data['content'];
        $post->save();

        $post->tags()->sync($data['tag']);

        return redirect()->route('post.index')->with('message', 'Пост ' . $data['title'] . ' отредактирован');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $title = $post->title;
        $post->tags()->sync([]);
        $post->delete();

        return redirect()->route('post.index')->with('message', 'Пост ' . $title . ' удален');
    }
}
