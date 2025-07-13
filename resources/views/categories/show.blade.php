@extends('layouts.mainapp')

@section('title', 'Category Index')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">All Category Posts   </h1>
    
 
    @foreach ($posts as $post)
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="me-3">
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" style="max-width: 400px;">
                        @endif
                        <h3 class="card-title mb-2">
                            <a href="{{ route('posts.show', $post) }}" class="text-decoration-none text-dark">
                                {{ $post->title }}
                               
                            </a>
                        </h3>
                        <p class="card-text text-muted mb-1">Created at: {{ $post->created_at->diffForHumans() }}</p>
                            <strong>Category:</strong>
                            @if($post->category)
                                <a href="{{ route('categories.show', $post->category) }}" class="text-decoration-none">
                                    {{ $post->category->name }}
                                </a>
                            @else
                                <span class="text-muted">No Category</span>
                            @endif
                        <p class="card-text">Body : {{ $post->body }}</p>
                    </div>
 
                </div>
            </div>
        </div>
    @endforeach
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
</div>
@endsection
