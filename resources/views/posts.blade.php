@extends('layout')

@section('content')
    <table>
        <tr>
            <td>Title</td>
            <td>Content</td>
            <td>Date</td>
            <td>Author</td>
            <td>Category</td>
        </tr>

    @forelse($posts as $post)
        <tr>
            <td>{{ $post->title }}</td>
            <td>{{ $post->content }}</td>
            <td>{{ $post->created_at }}</td>
            <td>{{ $post->user->name }}</td>
            <td>{{ $post->category->title }}</td>
        </tr>
    @empty
        <tr><p>Нет статей</p></tr>
    @endforelse
    </table>
    {{$posts->links()}}
@endsection