<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Exige autenticación para usar este controlador.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Redirige al usuario a su panel correspondiente según su rol.
     */
    public function index()
    {
        $usuario = Auth::user();

        // El Administrador va directo a gestionar a su personal
        if ($usuario->rol === 'Administrador') {
            return redirect()->route('usuarios.index'); 
        }

        // La Recepcionista va directo a la agenda/clientes para trabajar
        if ($usuario->rol === 'Recepcionista') {
            return redirect()->route('clientes.index');
        }

        // Si es un rol no definido, va a una pantalla de bienvenida genérica
        return view('home'); 
    }
}