<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class PageController extends Controller
{
    public function home()
    {
        return view('welcome');
    }

    public function about()
    {
            return view('about', [
                'name' => 'Housma',
                'isAdmin' => 0,
                'skills' => ['Laravel', 'PHP', 'MySQL']
            ]);
    }
    
    public function posts()
    {
        $posts = Post::latest()->get();
        return view('posts', compact('posts'));
    }

    public function contact()
    {
        return view('contact'); // You'll create this view soon
    }
}
