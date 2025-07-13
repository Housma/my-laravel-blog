@extends('layouts.mainapp')

@section('title', 'Trashed Posts')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">🗑 Trashed Posts</h1>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if ($posts->count())
        @foreach ($posts as $post)
            <div class="card mb-3 shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-start">
                    <div>
                        <h4 class="card-title">{{ $post->title }}</h4>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($post->body, 100) }}</p>
                        <small class="text-muted">Deleted {{ $post->deleted_at->diffForHumans() }}</small>
                    </div>
                    <div class="text-end">
                        <form action="{{ route('posts.restore', $post->id) }}" method="POST" class="mb-2">
                            @csrf
                            <button class="btn btn-success btn-sm w-100" type="submit">Restore</button>
                        </form>
                        <form action="{{ route('posts.forceDelete', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm w-100" type="submit" onclick="return confirm('Are you sure you want to permanently delete this post?')">Delete Permanently</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $posts->links() }}
        </div>
    @else
        <div class="alert alert-info">No trashed posts found.</div>
    @endif

    <a href="{{ route('posts.index') }}" class="btn btn-secondary mt-4">← Back to All Posts</a>
</div>
@endsection
