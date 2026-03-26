<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Si el usuario es el Jefe, lo mandamos al panel de usuarios
        if (auth()->user()->rol == 'Administrador') {
            return redirect()->route('usuarios.index');
        }
        
        // Si es la Recepcionista o Estilista, los mandamos al inventario de productos
        return redirect()->route('productos.index');
    }
}
