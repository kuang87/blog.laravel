<div id="sidebar">
    <div id="categories">
        Categories
        <ul id="categories">
            @foreach(\App\Category::all() as $category)
                <li>{{$category->title}}</li>
            @endforeach
        </ul>
    </div>
    <div id="tags">
        Tags
        <p>
        @foreach(\App\Tag::all() as $tag)
            <a href="{{ route('tag_route', $tag->title) }}">{{$tag->title}}</a>,&nbsp;
        @endforeach
        </p>
    </div>
</div>