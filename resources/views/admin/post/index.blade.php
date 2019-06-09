{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Posts</h1>
@stop

@section('content')
    @if(Session::has('message'))
        <p>{{Session::get('message')}}</p>
    @endif


    <a href="{{route('post.create')}}">Create</a><br><br>
    <table>
    @foreach($posts as $post)
        <tr>
            <td>{{$post->title}}</td>
            <td><a href="{{route('post.edit', $post->id)}}">Edit</a></td>
            <td>
                <form method="post" action="{{ route('post.destroy', $post->id) }}">
                    @method('DELETE')
                    @csrf
                    <button>Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </table>
@stop