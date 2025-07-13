<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'name' => 'required',
        ]);

        $data = $request->only('name');

        Category::create($data);

        return redirect()->route('categories.index')->with('status', 'Category created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $posts = $category->posts()->latest()->paginate(5); // Laravel way of "where category_id = ?"
        $categories = Category::all();

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $data = $request->only('name');
 

        $category->update($data);

        return redirect()->route('categories.index')->with('status', 'Category updated!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('status', 'Category deleted!');
    }
}
