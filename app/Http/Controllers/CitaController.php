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
    public function store(Request $request) 
    { 
        // 1. Validar que vengan los datos correctos
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'servicio' => 'required|string',
            'fecha' => 'required|date',
            'hora' => 'required',
            'estado' => 'required|string'
        ]);

        // 2. Guardar en la base de datos
        \App\Models\Cita::create($request->all());

        // 3. Redirigir a la tabla principal
        return redirect()->route('citas.index');
    }
    public function show(Cita $cita) { }
    public function edit(Cita $cita) { }
    public function update(Request $request, Cita $cita) { }
    public function destroy(Cita $cita) { 
        $cita->delete();
        return redirect()->route('citas.index');
    }
}