{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Tags</h1>
@stop

@section('content')
    @if(Session::has('message'))
        <p>{{Session::get('message')}}</p>
    @endif


    <a href="{{route('tag.create')}}">Create</a><br><br>
    <table>
    @foreach($tags as $tag)
        <tr>
            <td>{{$tag->title}}</td>
            <td><a href="{{route('tag.edit', $tag->id)}}">Edit</a></td>
            <td>
                <form method="post" action="{{ route('tag.destroy', $tag->id) }}">
                    @method('DELETE')
                    @csrf
                    <button>Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </table>
@stop