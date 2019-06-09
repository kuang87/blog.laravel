{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Posts</h1>
@stop

@section('content')
    @if(isset($post))
        <form method="post" action="{{route('post.update', $post->id)}}">
        @method('PUT')
    @else
        <form method="post" action="{{route('post.store')}}">
    @endif

        @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        Title: <input type="text" name="title" value="{{ old('title', $post->title ?? null) }}"><br>
        <br>
        Content: <textarea name="content">{{ old('content', $post->content ?? null) }}</textarea><br>
        Slug: <input type="text" name="slug" value="{{ old('slug', $post->slug ?? null) }}"><br>
        <br>
            Categories
        <select name="category">
            @foreach($categories as $category)
            <option @if(isset($post)) @if($post->category_id == $category->id) selected @endif @endif value="{{ $category->id }}">{{ $category->title }}</option>
            @endforeach
        </select>

            &nbsp;&nbsp;&nbsp;&nbsp;
            Tags
            @if(isset($post))
                @php($tag_id = $post->tags()->pluck('id')->toArray())
            @endif
            @foreach($tags as $tag)
                <input type="checkbox" name="tag[]" value="{{ $tag->id }}" @if(isset($tag_id)) @if(in_array($tag->id, $tag_id)) checked @endif @endif> {{ $tag->title }}
            @endforeach
            <br> <br>
        <button>Save</button>
    </form>
@stop