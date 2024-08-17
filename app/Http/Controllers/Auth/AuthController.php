<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión.
     */
    public function loginForm()
    {
        $title = "Inicio de sesión";
        return view('auth.login', compact('title'));
    }

    /**
     * Procesa la solicitud de inicio de sesión.
     */
    public function login(Request $request)
    {
        $credenciales = $request->only('email', 'password');

        if (Auth::attempt($credenciales)) {
            return redirect()->route('productos.index');
        }

        return redirect()->back();
    }

    /**
     * Procesa la solicitud de cierre de sesión.
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('loginForm');
    }

    /**
     * Muestra el formulario de registro.
     */
    public function registerForm()
    {
        $title = "Registro de usuario";
        return view('auth.register', compact('title'));
    }

    /**
     * Procesa la solicitud de registro de un nuevo usuario.
     */
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:30|unique:users',
            'password' => 'required|string|min:3',
        ]);

        $user = User::create([
            'name' => "Usuario",
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('productos.index');
    }
}