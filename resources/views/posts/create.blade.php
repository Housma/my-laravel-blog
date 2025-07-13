@extends('layouts.mainapp')

@section('title', 'Posts create')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Create Post</h1>

    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input name="title" type="text" class="form-control" id="title" value="{{ old('title') }}">
        </div>

        <div class="mb-3">
            <label for="body" class="form-label">Body:</label>
            <textarea name="body" class="form-control" id="body" rows="5">{{ old('body') }}</textarea>
        </div>
        
        <div class="mb-3">
            <label for="Category" class="form-label">Category:</label>
            <select name="category_id" class="form-control" id="Category">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Tags</label><br>
            @foreach ($tags as $tag)
                <div class="form-check form-check-inline">
                    <input 
                        class="form-check-input" 
                        type="checkbox" 
                        name="tags[]" 
                        value="{{ $tag->id }}"
                        {{ isset($post) && $post->tags->contains($tag->id) ? 'checked' : '' }}
                    >
                    <label class="form-check-label">{{ $tag->name }}</label>
                </div>
            @endforeach
        </div>
        
        <div class="mb-3">
            <label for="image">Post Image:</label>
            <input type="file" name="image" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>
@endsection