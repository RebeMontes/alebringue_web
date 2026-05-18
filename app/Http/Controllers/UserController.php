<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
        public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    
    }

    public function create()
    {
        return view('users.create');
    
    }

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
            'password' => bcrypt($request->password),
            'user_type' => $request->user_type,
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente');
    }

        public function edit($id)
    {
        $users = User::findOrFail($id);

        return view('users.edit', compact('users'));
    }

     public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
            'user_type' => 'required|in:user,admin',
            'status' => 'required|in:active,inactive',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'user_type' => $request->user_type,
            'status' => $request->status,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente');
    }

        public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function destroy($id)
    {
       $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente');
    }


        public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        $deletedCount = User::whereIn('id', $ids)->delete();
        
        return response()->json([
            'success' => true,
            'deletedCount' => $deletedCount
        ]);
    }

    public function bulkActivate(Request $request)
    {
        $ids = $request->ids;
        $updatedCount = User::whereIn('id', $ids)->update(['status' => 'active']);
        
        return response()->json([
            'success' => true,
            'updatedCount' => $updatedCount
        ]);
    }

    public function bulkDeactivate(Request $request)
    {
        $ids = $request->ids;
        $updatedCount = User::whereIn('id', $ids)->update(['status' => 'inactive']);
        
        return response()->json([
            'success' => true,
            'updatedCount' => $updatedCount
        ]);
    }
}
