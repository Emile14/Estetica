<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function index()
    {
        $citas = Cita::all();
        return view('citas.index', compact('citas'));
    }

public function create() 
    { 
        // Importa el modelo Cliente arriba si no lo tienes: use App\Models\Cliente;
        $clientes = \App\Models\Cliente::all(); 
        return view('citas.create', compact('clientes')); 
    }
    public function store(Request $request) { }
    public function show(Cita $cita) { }
    public function edit(Cita $cita) { }
    public function update(Request $request, Cita $cita) { }
    public function destroy(Cita $cita) { 
        $cita->delete();
        return redirect()->route('citas.index');
    }
}