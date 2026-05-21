<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Word;
use App\Models\EnglishLevel;
use App\Models\Category;

class WordController extends Controller
{
   public function index()
    {
        $words = Word::with('category')->paginate(10);
    $categories = Category::has('words')->get(); ;

        $words = Word::with('category')->latest()->get();
        return view('words.index', compact('words', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('words.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'word' => 'required',
            'translation' => 'required',
            'category_id' => 'required|exists:categories,id'
        ]);

        Word::create($request->all());

        return redirect()->route('words.index')
            ->with('success', 'Palabra creada correctamente');
    }

    public function edit(Word $word)
    {
        $categories = Category::all();
        return view('words.edit', compact('word', 'categories'));
    }

    public function update(Request $request, Word $word)
    {
        $request->validate([
            'word' => 'required',
            'translation' => 'required',
            'category_id' => 'required|exists:categories,id'
        ]);

        $word->update($request->all());

        return redirect()->route('words.index')
            ->with('success', 'Palabra actualizada');
    }

    public function destroy(Word $word)
    {
        $word->delete();

        return redirect()->route('words.index')
            ->with('success', 'Palabra eliminada');
    }

        public function show($id)
    {
        $word = Word::with('category')->findOrFail($id);
        return view('words.show', compact('word'));
    }
}
