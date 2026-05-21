<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function home()
    {
        return view('home.index');
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 1. Buscamos el usuario por su email en Supabase
        $user = User::where('email', $credentials['email'])->first();

        // 2. Verificación limpia y agnóstica del formato
        if ($user && password_verify($credentials['password'], $user->password)) {

            // 3. Autenticación manual en la sesión web de Laravel
            Auth::login($user);

            return redirect()->intended('/home');
        }

        // Error genérico por seguridad
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no son correctas.',
        ]);
    }

        public function register()
    {
        #Validar los datos del registro
        $validatedData = request()->validate([
            'name'=> 'required | string | max:255',
            'email'=> 'required | string | email | max:255 | unique:users',
            'password'=> 'required | string | min:8 | confirmed',
            'password_confirmation'=> 'required | string | min:8'
        ]);

        #Crear el usuario
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'user_type' => 'user', //Asignar un tipo de usuario por defecto
        ]);

        #Redirigir o iniciar sesion automaticamente
        Auth::login($user);

        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
