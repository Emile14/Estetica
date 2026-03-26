<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Muestra la lista de todos los usuarios
    public function index()
    {
        $usuarios = User::all();
        return view('usuarios.index', compact('usuarios'));
    }

    // Muestra el formulario para crear un usuario nuevo
    public function create()
    {
        // Definimos los roles disponibles para pasarlos al formulario (select)
        $roles = ['Administrador', 'Recepcionista', 'Estilista'];
        return view('usuarios.create', compact('roles'));
    }

    // Guarda el nuevo usuario en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'rol' => 'required|string',
            'telefono' => 'required|string|max:15',
        ]);

        User::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
            'telefono' => $request->telefono,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    // Muestra el formulario para editar a un usuario
    public function edit(string $id)
    {
        $usuario = User::findOrFail($id);
        $roles = ['Administrador', 'Recepcionista', 'Estilista'];
        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    // Actualiza al usuario en la base de datos
    public function update(Request $request, string $id)
    {
        $usuario = User::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id, // Ignora el email actual del usuario al validar
            'rol' => 'required|string',
            'telefono' => 'required|string|max:15',
        ]);

        $usuario->update([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'rol' => $request->rol,
            'telefono' => $request->telefono,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    // Elimina al usuario
    public function destroy(string $id)
    {
        User::destroy($id);
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado del sistema.');
    }
}