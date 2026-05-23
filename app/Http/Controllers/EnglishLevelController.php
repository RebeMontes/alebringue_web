<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EnglishLevel;

class EnglishLevelController extends Controller
{
    public function index()
    {
        $levels = EnglishLevel::latest()->get();
        return view('levels.index', compact('levels'));
    }

    public function create()
    {
        return view('levels.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:english_levels,code',
            'name' => 'required',
            'description' => 'required'
        ]);

        EnglishLevel::create($request->all());

        return redirect()->route('levels.index')
            ->with('success', 'Nivel creado correctamente');
    }

    public function show(EnglishLevel $level)
    {
        return view('levels.show', compact('level'));
    }

    public function edit(EnglishLevel $level)
    {
        return view('levels.edit', compact('level'));
    }

    public function update(Request $request, EnglishLevel $level)
    {
        $request->validate([
            'code' => 'required|unique:english_levels,code,' . $level->id,
            'name' => 'required',
            'description' => 'required'
        ]);

        $level->update($request->all());

        return redirect()->route('levels.index')
            ->with('success', 'Nivel actualizado');
    }

    public function destroy(EnglishLevel $level)
    {
        $level->delete();

        return redirect()->route('levels.index')
            ->with('success', 'Nivel eliminado');
    }
}
        