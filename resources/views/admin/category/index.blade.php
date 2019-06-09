{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Categories</h1>
@stop

@section('content')
    @if(Session::has('message'))
        <p>{{Session::get('message')}}</p>
    @endif


    <a href="{{route('category.create')}}">Create</a><br><br>
    <table>
    @foreach($categories as $category)
        <tr>
            <td>{{$category->title}}</td>
            <td><a href="{{route('category.edit', $category->id)}}">Edit</a></td>
            <td>
                <form method="post" action="{{ route('category.destroy', $category->id) }}">
                    @method('DELETE')
                    @csrf
                    <button>Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </table>
@stop