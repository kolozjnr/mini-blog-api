@extends('front.layout')

@section('content')
<h2>Create Post</h2>

@if($errors->any())
    <div style="color:red;">
        {{ implode(', ', $errors->all()) }}
    </div>
@endif

<form method="POST" action="{{ route('blog.store') }}">
    @csrf
    <label>Title:</label>
    <input type="text" name="title" required>
    
    <label>Body:</label>
    <textarea name="body" required></textarea>
    
    <button type="submit">Publish</button>
</form>
@endsection
