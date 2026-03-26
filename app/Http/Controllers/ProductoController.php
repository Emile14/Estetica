<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        Producto::create($request->all());
        return redirect()->route('productos.index');
    }

    public function destroy($id)
    {
        Producto::destroy($id);
        return redirect()->route('productos.index');
    }
    // Muestra el formulario con los datos cargados
public function edit($id)
{
    $producto = Producto::findOrFail($id);
    return view('productos.edit', compact('producto'));
}

// Procesa la actualización en la BD
public function update(Request $request, $id)
{
    $datosProducto = $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
        'precio' => 'required|numeric',
        'stock' => 'required|integer',
    ]);

    Producto::where('id', $id)->update($datosProducto);

    return redirect('productos')->with('mensaje', 'Producto actualizado con éxito');
}
}