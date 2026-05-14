<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\ReservaProducto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::withSum(['reservas as apartados' => function($query) {
            $query->where('estado', 'Apartado');
        }], 'cantidad')->get();

        if (auth()->user()->rol != 'Cliente') {
            $reservasPendientes = ReservaProducto::with(['cliente', 'producto', 'cita'])
                ->where('estado', 'Apartado')
                ->get();
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
        return redirect()->route('productos.index')->with('success', 'Producto agregado con éxito.');
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

    public function aprobarReserva(ReservaProducto $reserva) {
        $producto = $reserva->producto;
        if ($producto->stock >= $reserva->cantidad) {
            $producto->stock -= $reserva->cantidad;
            $producto->save();
            
            $reserva->update(['estado' => 'Entregado']); 
            return back()->with('success', 'Producto entregado y descontado del stock general.');
        }
        return back()->with('error', 'No hay stock suficiente.');
    }

    public function rechazarReserva(ReservaProducto $reserva) {
        $reserva->update(['estado' => 'Rechazado']);
        return back()->with('success', 'Solicitud cancelada.');
    }
}