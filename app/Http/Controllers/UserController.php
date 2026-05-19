<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // LISTADO CON BUSQUEDA + PAGINACION
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%");
            });
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $users = $query->latest()->paginate(10)->withQueryString();

        return view('users.index', compact('users'));
    }

    // FORM CREATE
    public function create()
    {
        return view('users.create');
    }

    // GUARDAR
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'user_type' => 'required|in:user,admin',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type,
            'status' => 'active',
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente');
    }

    // EDIT (MODEL BINDING 🔥)
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // UPDATE
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$user->id}",
            'password' => 'nullable|min:8',
            'user_type' => 'required|in:user,admin',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->only(['name', 'email', 'user_type', 'status']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado');
    }

    // SHOW
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // DELETE
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado');
    }

    // BULK DELETE
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:users,id'
        ]);

        $deleted = User::whereIn('id', $request->ids)->delete();

        return response()->json([
            'success' => true,
            'deletedCount' => $deleted
        ]);
    }

    // BULK ACTIVATE
    public function bulkActivate(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:users,id'
        ]);

        $updated = User::whereIn('id', $request->ids)->update(['status' => 'active']);

        return response()->json([
            'success' => true,
            'updatedCount' => $updated
        ]);
    }

    // BULK DEACTIVATE
    public function bulkDeactivate(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:users,id'
        ]);

        $updated = User::whereIn('id', $request->ids)->update(['status' => 'inactive']);

        return response()->json([
            'success' => true,
            'updatedCount' => $updated
        ]);
    }
}