<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/tag/index', ['tags' => Tag::latest()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/tag/form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|unique:posts',
            'slug' => 'required|unique:posts|max:255',
        ]);

        $tag = new Tag();
        $tag->title = $data['title'];
        $tag->slug = $data['slug'];
        $tag->save();

        return redirect()->route('tag.index')->with('message', 'Тэг ' . $data['title'] . ' создан');
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
    public function edit(Tag $tag)
    {
        return view('admin/tag/form', ['tag' => $tag]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $data = $request->validate([
            'title' => 'required|unique:tags,title,' . $tag->id . ',id',
            'slug' => 'required|unique:tags,slug,' . $tag->id . ',id|max:255',
        ]);

        $tag->title = $data['title'];
        $tag->slug = $data['slug'];
        $tag->save();

        return redirect()->route('tag.index')->with('message', 'Тэг ' . $data['title'] . ' отредактирован');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $title = $tag->title;
        $tag->posts()->sync([]);
        $tag->delete();
        return redirect()->route('tag.index')->with('message', 'Тэг ' . $title . ' удалена');
    }
}
