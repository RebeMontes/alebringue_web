<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EnglishLevel;

class EnglishLevelController extends Controller
{
    public function index()
    {
        $levels = EnglishLevel::all();
        return view('levels.index', compact('levels'));
    }

    public function create()
    {
        return view('levels.create');
    }

    public function store(Request $request)
    {
        EnglishLevel::create($request->all());

        return redirect()->route('levels.index');
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
        $level->update($request->all());

        return redirect()->route('levels.index');
    }

    public function destroy(EnglishLevel $level)
    {
        $level->delete();

        return redirect()->route('levels.index');
    }
}
        