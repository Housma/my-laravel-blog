@extends('layouts.mainapp')

@section('title', 'posts')

@section('content')
    <h2>Latest Posts</h2>

    @forelse ($posts as $post)
        <div style="margin-bottom: 20px;">
            <h3>{{ $post->title }}</h3>
            <p>{{ $post->body }}</p>
            <small>Published: {{ $post->created_at->diffForHumans() }}</small>
            <small>Published: {{ $post->created_at }}</small>
        </div>
    @empty
        <p>No posts yet.</p>
    @endforelse
@endsection