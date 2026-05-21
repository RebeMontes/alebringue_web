<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 

class HomeController extends Controller
{
   public function index()
    {
        $user = auth()->user();

        if ($user->user_type === 'admin') {
            $users = User::all();
            return view('home.index', compact('user', 'users'));
        }

        return view('home.user_index', compact('user'));
    }
}
