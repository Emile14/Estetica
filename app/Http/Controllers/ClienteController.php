<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Muestra la tabla con las columnas de phpMyAdmin.
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('lista_clientes', compact('clientes'));
    }

    /**
     * Muestra el formulario para crear.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Guarda los nuevos campos (user_id, nombre, email, telefono).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'  => 'nullable|integer',
            'nombre'   => 'required|max:75',
            'email'    => 'nullable|email|max:100',
            'telefono' => 'nullable|max:20',
        ]);

        Cliente::create($validated);

        return redirect()->route('clientes.index')->with('success', 'Cliente registrado exitosamente.');
    }

    /**
     * Muestra el formulario de edición con los datos actuales.
     */
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Actualiza los campos en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id'  => 'nullable|integer',
            'nombre'   => 'required|max:75',
            'email'    => 'nullable|email|max:100',
            'telefono' => 'nullable|max:20',
        ]);

        $cliente = Cliente::findOrFail($id);
        $cliente->update($validated);

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }

    /**
     * Elimina el registro.
     */
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado.');
    }
}