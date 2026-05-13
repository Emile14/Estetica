<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();

        // Redirección según el rol de Blanca Glow
        if ($user->rol == 'Administrador') {
            return redirect()->route('usuarios.index');
        } 
        
        if ($user->rol == 'Recepcionista') {
            return redirect()->route('citas.index');
        }

        return view('home');
    }
}