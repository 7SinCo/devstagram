<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index() {
        // Verifica si el usuario está autenticado
        if (Auth::check()) {
            // Redirige al usuario a la ruta deseada si ya está autenticado
            return redirect()->route('posts.index', auth()->user()->username);
        }
        
        return view('auth.login');
    }

    public function store(Request $request) {
        // Validación
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return back()->with('mensaje', 'Credenciales incorrectas');
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}