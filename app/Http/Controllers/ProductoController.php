<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\ReservaProducto; // 👈 ¡Esta era la importación que faltaba!
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();

        // Si es Admin o Recepción, busca las reservas pendientes. Si es cliente, crea un arreglo vacío.
        if (auth()->user()->rol != 'Cliente') {
            $reservasPendientes = ReservaProducto::with(['cliente', 'producto'])->where('estado', 'Pendiente')->get();
        } else {
            $reservasPendientes = collect(); 
        }

        return view('productos.index', compact('productos', 'reservasPendientes'));
    }

    public function create() { 
        return view('productos.create'); 
    }

    public function store(Request $request) {
        Producto::create($request->all());
        return redirect()->route('productos.index')->with('success', 'Producto agregado al catálogo.');
    }

    public function edit(Producto $producto) { 
        return view('productos.edit', compact('producto')); 
    }

    public function update(Request $request, Producto $producto) {
        $producto->update($request->all());
        return redirect()->route('productos.index')->with('success', 'Producto actualizado.');
    }

    public function destroy(Producto $producto) {
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado.');
    }

    // --- FUNCIONES DE APARTADO ---

    public function solicitar(Request $request, Producto $producto) {
        ReservaProducto::create([
            'cliente_id' => auth()->user()->cliente->id,
            'producto_id' => $producto->id,
            'cantidad' => 1,
            'estado' => 'Pendiente'
        ]);
        return back()->with('success', '¡Solicitud enviada! El administrador la revisará pronto.');
    }

    public function aprobarReserva(ReservaProducto $reserva) {
        $producto = $reserva->producto;
        if ($producto->stock >= $reserva->cantidad) {
            $producto->stock -= $reserva->cantidad;
            $producto->save();
            
            $reserva->update(['estado' => 'Aprobado']);
            return back()->with('success', 'Producto apartado y stock descontado.');
        }
        return back()->with('error', 'No hay stock suficiente en el inventario.');
    }

    public function rechazarReserva(ReservaProducto $reserva) {
        $reserva->update(['estado' => 'Rechazado']);
        return back()->with('success', 'Solicitud rechazada.');
    }
}