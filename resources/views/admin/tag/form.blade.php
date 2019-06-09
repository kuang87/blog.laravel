{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Tags</h1>
@stop

@section('content')
    @if(isset($tag))
        <form method="post" action="{{route('tag.update', $tag->id)}}">
        @method('PUT')
    @else
        <form method="post" action="{{route('tag.store')}}">
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

        Title: <input type="text" name="title" value="{{ old('title', $tag->title ?? null) }}"><br>
        <br>
        Slug: <input type="text" name="slug" value="{{ old('slug', $tag->slug ?? null) }}"><br>
        <br>
        <button>Save</button>
    </form>
@stop