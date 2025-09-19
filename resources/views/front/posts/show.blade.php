@extends('front.layout')

@section('content')
<h2>{{ $post['title'] }}</h2>
<p>{{ $post['body'] }}</p>
<p><em>By {{ $post['author']['name'] }} | {{ $post['created_at'] }}</em></p>

<a href="{{ route('blog.index') }}">Back to posts</a>
@endsection
