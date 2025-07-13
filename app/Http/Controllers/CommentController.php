<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'author_name' => 'required',
            'content' => 'required',
        ]);

        $post->comments()->create($request->only('author_name', 'content'));

        return back()->with('status', 'Comment added!');
    }
}
