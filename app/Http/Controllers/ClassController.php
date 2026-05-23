<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\EnglishLevel;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    // ── ADMIN ────────────────────────────────────────────────────────────────

    public function index()
    {
        $classrooms = Classroom::with(['teacher', 'level', 'students'])->get();
        return view('classrooms.index', compact('classrooms'));
    }


    public function create()
    {
        $levels   = EnglishLevel::all();
        $teachers = Teacher::all();
        return view('classrooms.create', compact('levels', 'teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:120',
            'schedule'   => 'nullable|string|max:100',
            'teacher_id' => 'required|exists:teachers,id',
            'level_id'   => 'nullable|exists:english_levels,id',
        ]);

        Classroom::create([
            'name'       => $request->name,
            'code'       => Classroom::generateCode(),
            'schedule'   => $request->schedule,
            'teacher_id' => $request->teacher_id,
            'level_id'   => $request->level_id,
            'is_active'  => true,
        ]);

        return redirect()->route('classrooms.index')
                         ->with('success', 'Salón creado exitosamente.');
    }

    public function show(Classroom $classroom)
    {
        $classroom->load(['teacher', 'level', 'students']);
        return view('classrooms.show', compact('classroom'));
    }

    public function edit(Classroom $classroom)
    {
        $levels   = EnglishLevel::all();
        $teachers = Teacher::all();
        return view('classrooms.edit', compact('classroom', 'levels', 'teachers'));
    }

    public function update(Request $request, Classroom $classroom)
    {
        $request->validate([
            'name'       => 'required|string|max:120',
            'schedule'   => 'nullable|string|max:100',
            'teacher_id' => 'required|exists:teachers,id',
            'level_id'   => 'nullable|exists:english_levels,id',
        ]);

        $classroom->update($request->only('name', 'schedule', 'teacher_id', 'level_id', 'is_active'));

        return redirect()->route('classrooms.index')
                         ->with('success', 'Salón actualizado.');
    }

    public function destroy(Classroom $classroom)
    {
        $classroom->delete();
        return back()->with('success', 'Salón eliminado.');
    }

    // ── USUARIO ──────────────────────────────────────────────────────────────

    public function userIndex()
    {
        $myClassrooms = Auth::user()
            ->classrooms()
            ->with(['teacher', 'level'])
            ->where('is_active', true)
            ->get();

        return view('classrooms.user_index', compact('myClassrooms'));
    }

    public function join(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $code      = strtoupper(trim($request->code));
        $classroom = Classroom::where('code', $code)->where('is_active', true)->first();

        if (! $classroom) {
            return back()->withErrors(['code' => 'Código inválido o salón no activo.'])->withInput();
        }

        $user = Auth::user();

        if ($classroom->students()->where('user_id', $user->id)->exists()) {
            return back()->withErrors(['code' => 'Ya estás inscrito en este salón.'])->withInput();
        }

        $classroom->students()->attach($user->id);

        return back()->with('success', "¡Te uniste a «{$classroom->name}»!");
    }

    public function enter(Classroom $classroom)
    {
        if (! $classroom->students()->where('user_id', Auth::id())->exists()) {
            abort(403);
        }

        return view('classrooms.room', compact('classroom'));
    }
}