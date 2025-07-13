@extends('layouts.mainapp')

@section('title', 'Posts Index')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">All Posts   </h1>
    
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Create New Post</a>
    </div>
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('categories.index') }}" class="btn btn-success">Create New Category</a>
    </div>

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
<form method="GET" action="{{ route('posts.index') }}" class="row g-2 align-items-end mb-4">
    <div class="col-md-4">
        <label for="search" class="form-label">Search</label>
        <input type="text" name="search" id="search" class="form-control"
               value="{{ request('search') }}" placeholder="Search posts...">
    </div>

    <div class="col-md-3">
        <label for="category" class="form-label">Category</label>
        <select name="category" id="category" class="form-select">
            <option value="">-- All Categories --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label">Tags</label>
        <div class="d-flex flex-wrap">
            @foreach($tags as $tag)
                <div class="form-check me-3 mb-2">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="tags[]"
                        value="{{ $tag->id }}"
                        id="tag-{{ $tag->id }}"
                        {{ is_array(request('tags')) && in_array($tag->id, request('tags')) ? 'checked' : '' }}
                    >
                    <label class="form-check-label" for="tag-{{ $tag->id }}">
                        {{ $tag->name }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <div class="col-md-2">
        
        <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
        <button type="submit" class="btn btn-primary w-100">Filter</button>
    </div>
</form>


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
                           
                            @if($post->category)
                                <a href="{{ route('categories.show', $post->category) }}" class="badge bg-success text-white">
                                    {{ $post->category->name }}
                                </a>
                            @endif
                        <p class="card-text">Body : {{ $post->body }}</p>
                        @if($post->tags->count())
                            <div class="mt-2">
                                @foreach ($post->tags as $tag)
                                    <span class="badge bg-info text-dark">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="text-end">
                        <a href="{{ route('posts.show', $post) }}" class="btn btn-sm btn-outline-secondary mb-2 w-100">View</a>
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-outline-secondary mb-2 w-100">Edit</a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger w-100">Delete</button>
                        </form>
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
