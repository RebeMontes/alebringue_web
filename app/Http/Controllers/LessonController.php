<?php

namespace App\Http\Controllers;
use App\Models\Lesson;
use App\Models\EnglishLevel;
use App\Models\Word;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = Lesson::with('level')->paginate(10);
        $levels = EnglishLevel::all();
        return view('lessons.index', compact('lessons', 'levels'));
    }

    public function create()
    {
        $levels = EnglishLevel::all();
        $words = Word::all();

        return view('lessons.create', compact('levels', 'words'));
    }

    public function store(Request $request)
    {
        $lesson = Lesson::create([
            'title' => $request->title,
            'description' => $request->description,
            'level_id' => $request->level_id
        ]);

        if ($request->words) {
            $lesson->words()->sync($request->words);
        }

        return redirect()->route('lessons.index');
    }

    public function edit(Lesson $lesson)
    {
        $levels = EnglishLevel::all();
        $words = Word::all();

        return view('lessons.edit', compact('lesson','levels','words'));
    }

    
    public function show(Lesson $lesson)
    {
        return view('lessons.show', compact('lesson'));
    }

    public function update(Request $request, Lesson $lesson)
    {
        $lesson->update($request->all());

        if ($request->words) {
            $lesson->words()->sync($request->words);
        }

        return redirect()->route('lessons.index');
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return back();
    }

    public function lessonPage()
    {
        $lessons = Lesson::with('level')->get();

        return view('lessons.pages.lesson_page', compact('lessons'));
    }

    public function lessonContentPage(Lesson $lesson)
    {
        $words = $lesson->words()->get();
        return view('lessons.pages.lesson_content_page', compact('lesson'));
    }
}