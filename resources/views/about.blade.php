@extends('layouts.mainapp')

@section('title', 'About')

@section('content')
    <h2>Hello, {{ $name }}</h2>

    @if($isAdmin)
        <p>You are an admin!</p>
    @else
        <p>You are a regular user.</p>
    @endif

    <h3>Your Skills:</h3>
    <ul>
        @foreach($skills as $skill)
            <li>{{ $skill }}</li>
        @endforeach
    </ul>
@endsection