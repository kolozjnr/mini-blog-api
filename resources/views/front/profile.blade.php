@extends('front.layout')

@section('content')
<h2>Author Profile</h2>

<ul>
    <li>
        <p>Name <strong>{{$author->name}}</strong></p>
        <p>Email <strong>{{$author->email}}</strong></p>
    </li>
</ul>

@endsection
