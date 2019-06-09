{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Categories</h1>
@stop

@section('content')
    @if(isset($category))
        <form method="post" action="{{route('category.update', $category->id)}}">
        @method('PUT')
    @else
        <form method="post" action="{{route('category.store')}}">
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

        Title: <input type="text" name="title" value="{{ old('title', $category->title ?? null) }}"><br>
        <br>
        Slug: <input type="text" name="slug" value="{{ old('slug', $category->slug ?? null) }}"><br>
        <br>
        <button>Save</button>
    </form>
@stop