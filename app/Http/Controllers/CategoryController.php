<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
       $categories = Category::with('words')->orderBy('created_at', 'desc')->get();
    // $categories = Category::with('words')->orderBy('created_at', 'desc')->paginate(10);
    
    return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')
            ->with('success', 'Categoría creada');
    }

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')
            ->with('success', 'Categoría actualizada');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Categoría eliminada');
    }
}
