@extends('layouts.mainapp')

@section('title', 'Posts Index')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">All Posts   </h1>

 

 

    @foreach ($posts as $post)
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="me-3">
                        <h3 class="card-title mb-2">
                            <a href="{{ route('posts.show', $post) }}" class="text-decoration-none text-dark">
                                {{ $post->title }}
                               
                            </a>
                        </h3>
                        <p class="card-text">{{ $post->body }}</p>
                    </div>
                    <div class="text-end">
                       
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
