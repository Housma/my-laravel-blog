<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Post::query()->with(['category', 'tags']);

        // 🔍 Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('body', 'like', '%' . $request->search . '%');
            });
        }

        // 📂 Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // 🏷️ Filter by tags
        if ($request->filled('tags')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->whereIn('tags.id', $request->tags);
            });
        }

        $posts = $query->latest()->paginate(5)->withQueryString();
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.index', compact('posts', 'categories', 'tags'));
    }
    public function list()
    {
        $posts = Post::latest()->get();
        return view('posts.list', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::get();
        $categories = Category::get();
        return view('posts.create', compact('categories','tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|min:10',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|array|exists:tags,id',
            'image' => 'nullable|image|max:2048' // 2MB
        ]);

        $data = $request->only('title', 'body', 'category_id');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }
        
        $post = Post::create($data);
        $post->tags()->attach($request->tags);
        return redirect()->route('posts.index')->with('status', 'Post created!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {   
        $tags = Tag::get();
        $categories = Category::get();
         return view('posts.edit', compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tags' => 'array',
        ]);

        $data = $request->only('title', 'body', 'category_id');

        if ($request->hasFile('image')) {
            if ($post->image && \Storage::disk('public')->exists($post->image)) {
                \Storage::disk('public')->delete($post->image);
            }

            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);
        $post->tags()->sync($request->tags); 
        return redirect()->route('posts.index')->with('status', 'Post updated!');

    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('status', 'Post moved to trash.');
    }

    public function trashed()
    {
        $posts = Post::onlyTrashed()->paginate(5);
        return view('posts.trashed', compact('posts'));
    }

    public function restore($id)
    {
        Post::onlyTrashed()->where('id', $id)->restore();
        return redirect()->route('posts.trashed')->with('status', 'Post restored.');
    }

    public function forceDelete($id)
    {
        Post::onlyTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('posts.trashed')->with('status', 'Post permanently deleted.');
    }
}
