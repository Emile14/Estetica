<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Cliente;
use Illuminate\Http\Request;

class CitaController extends Controller
{
public function index()
    {
        $user = auth()->user();
        
        if ($user->rol == 'Cliente') {
            // El cliente SOLO ve su propio historial de citas (Pendientes y Confirmadas)
            $citas = Cita::where('cliente_id', $user->cliente->id)->orderBy('fecha', 'desc')->get();
            $citasPendientes = collect(); // Array vacío porque el cliente no aprueba
        } else {
            // Admin y Recepcionista ven la Agenda Oficial (Solo las Confirmadas)
            $citas = Cita::where('estado', 'Confirmada')->orderBy('fecha', 'asc')->get();
            // Y cargamos las solicitudes nuevas para mostrarlas en las notificaciones
            $citasPendientes = Cita::with('cliente')->where('estado', 'Pendiente')->orderBy('fecha', 'asc')->get();
        }

        return view('citas.index', compact('citas', 'citasPendientes'));
    }

    public function create()
    {
        $clientes = Cliente::orderBy('nombre')->get();
        return view('citas.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'servicio'   => 'required|string',
            'fecha'      => 'required|date',
            'hora'       => 'required',
            'estado'     => 'required|string',
        ]);

        Cita::create($request->all());

        return redirect()->route('citas.index')->with('success', 'Cita agendada correctamente.');
    }

    public function show(Cita $cita)
    {
        return redirect()->route('citas.index');
    }

    public function edit(Cita $cita)
    {
        $clientes = Cliente::orderBy('nombre')->get();
        return view('citas.edit', compact('cita', 'clientes'));
    }

    public function update(Request $request, Cita $cita)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'servicio'   => 'required|string',
            'fecha'      => 'required|date',
            'hora'       => 'required',
            'estado'     => 'required|string',
        ]);

        $cita->update($request->all());

        return redirect()->route('citas.index')->with('success', 'Cita actualizada correctamente.');
    }

    public function destroy(Cita $cita)
    {
        $cita->delete();
        return redirect()->route('citas.index')->with('success', 'Cita eliminada.');
    }
}