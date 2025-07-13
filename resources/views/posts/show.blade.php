@extends('layouts.mainapp')

@section('title', 'Posts View'. ' - ' . $post->title)
@section('content')
<div class="container mt-5">
    <h1 class="mb-4">{{  $post->title }}</h1>
        <div class="mb-3">
          
           {{ old('body', $post->body) }}
        </div>

        @if ($post->image)
            <div style="margin-bottom: 10px;">
                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" style="max-width: 300px;">
            </div>
        @endif
      <h3 class="mt-5 mb-4">Comments</h3>

@foreach($post->comments as $comment)
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title mb-1">{{ $comment->author_name }}</h5>
            <p class="card-text">{{ $comment->content }}</p>
        </div>
    </div>
@endforeach

<div class="card mt-4">
    <div class="card-header">Leave a Comment</div>
    <div class="card-body">
        <form method="POST" action="{{ route('comments.store', $post->id) }}">
            @csrf

            <div class="mb-3">
                <label for="author_name" class="form-label">Your Name</label>
                <input type="text" name="author_name" id="author_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Your Comment</label>
                <textarea name="content" id="content" rows="3" class="form-control" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Add Comment</button>
        </form>
    </div>
</div>



</div>
@endsection
