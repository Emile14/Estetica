<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Servicior;
use App\Models\Producto;
use App\Models\ReservaProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CitaController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->rol == 'Cliente') {
            $citas = Cita::where('cliente_id', $user->cliente->id)->orderBy('fecha', 'desc')->get();
            $citasPendientes = collect();
        } else {
            $citas = Cita::where('estado', 'Confirmada')->orderBy('fecha', 'asc')->get();
            $citasPendientes = Cita::with('cliente')->where('estado', 'Pendiente')->orderBy('fecha', 'asc')->get();
        }

        return view('citas.index', compact('citas', 'citasPendientes'));
    }

    public function create()
    {
        $servicios = Servicior::all();
        $productos = Producto::where('stock', '>', 0)->get();
        return view('citas.create', compact('servicios', 'productos'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $clienteId = ($user->rol == 'Cliente') ? $user->cliente->id : $request->cliente_id;

        if ($user->rol == 'Cliente') {
            $tienePendiente = Cita::where('cliente_id', $clienteId)->where('estado', 'Pendiente')->exists();
            if ($tienePendiente) {
                return back()->with('error', 'Ya tienes una solicitud de cita pendiente. Espera a que sea procesada.');
            }
        }

        $ocupado = Cita::where('fecha', $request->fecha)
                       ->where('hora', $request->hora)
                       ->where('estado', 'Confirmada')
                       ->exists();
        if ($ocupado) {
            return back()->with('error', 'Esta fecha y hora ya están ocupadas. Por favor elige otro horario.');
        }

        return DB::transaction(function () use ($request, $user, $clienteId) {
            $estado = ($user->rol == 'Cliente') ? 'Pendiente' : 'Confirmada';
            
            $servicio = Servicior::where('nombre', $request->servicio)->first();
            $total = $servicio->precio ?? 0;

            if ($request->producto_id) {
                $prod = Producto::find($request->producto_id);
                $total += ($prod->precio * $request->cantidad_producto);
            }

            $cita = Cita::create([
                'cliente_id' => $clienteId,
                'servicio' => $request->servicio,
                'fecha' => $request->fecha,
                'hora' => $request->hora,
                'estado' => $estado,
                'total' => $total,
            ]);

            if ($request->producto_id) {
                ReservaProducto::create([
                    'cliente_id' => $clienteId,
                    'producto_id' => $request->producto_id,
                    'cita_id' => $cita->id,
                    'cantidad' => $request->cantidad_producto,
                    'estado' => ($user->rol == 'Cliente') ? 'Pendiente' : 'Apartado'
                ]);
            }

            return redirect()->route('citas.index')->with('success', 'Solicitud enviada correctamente.');
        });
    }

    public function aprobar(Cita $cita)
    {
        $cita->update(['estado' => 'Confirmada']);
        ReservaProducto::where('cita_id', $cita->id)->update(['estado' => 'Apartado']);
        return back()->with('success', 'Cita confirmada y producto apartado en inventario.');
    }

    public function destroy(Cita $cita)
    {
        $cita->delete();
        return back()->with('success', 'Cita cancelada.');
    }
}