@extends('front.layout')

@section('content')
<h2>All Posts</h2>

<form method="get">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search posts...">
    <button type="submit">Search</button>
</form>

<ul>
    @foreach($posts as $post)
        <li>
            <a href="{{ route('blog.show', $post->id) }}">
                <strong>{{ $post->title }}</strong>
            </a>
            <p>{{ \Illuminate\Support\Str::limit($post->body, 100) }}</p>

            <p>Author: <a href="{{ route('blog.author', $post->author->id) }}">
                <strong>{{ $post->author->name }}</strong>
            </a></p>
            <p>Created: {{ $post->created_at->diffForHumans() }}</p>
            <p>Updted: {{ $post->updated_at->diffForHumans() }}</p>
        </li>
        
    @endforeach
</ul>

<div>
    {{ $posts->appends(request()->query())->links() }}
</div>
@endsection
