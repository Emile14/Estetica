@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    @if(auth()->user()->rol != 'Cliente' && $reservasPendientes->count() > 0)
        <div class="bg-blue-50 border-l-8 border-blue-400 p-6 mb-10 rounded-2xl shadow-sm">
            <h3 class="text-blue-800 font-bold text-xl mb-4">
                <i class="bi bi-box-seam-fill"></i> Productos Apartados (Listos para Entregar)
            </h3>
            <div class="grid gap-4">
                @foreach($reservasPendientes as $reserva)
                <div class="bg-white p-4 rounded-xl shadow-sm flex justify-between items-center border border-blue-100">
                    <div>
                        <p class="text-oscuro font-bold">{{ $reserva->cliente->nombre }}</p>
                        <p class="text-sm text-gray-500">
                            Cita agendada para: <b>{{ $reserva->cita->fecha ?? 'Sin fecha' }}</b> <br>
                            Entregar: <b>{{ $reserva->cantidad }} unidad(es) de {{ $reserva->producto->nombre }}</b>
                        </p>
                    </div>
                    <div class="flex gap-2">
                        <form action="{{ route('reservas.aprobar', $reserva->id) }}" method="POST">
                            @csrf @method('PATCH')
                            <button class="bg-blue-500 text-white px-5 py-2 rounded-lg font-bold hover:bg-blue-600 transition shadow">Entregar Producto</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-playfair font-bold text-oscuro">Inventario Blanca Glow</h2>
        @if(auth()->user()->rol != 'Cliente')
            <a href="{{ route('productos.create') }}" class="bg-rosa-fuerte text-white px-6 py-3 rounded-xl font-bold shadow-md hover:scale-105 transition">
                + Nuevo Producto
            </a>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($productos as $p)
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition">
            <div>
                <div class="flex justify-between items-start mb-4">
                    <h3 class="font-bold text-xl text-oscuro leading-tight">{{ $p->nombre }}</h3>
                    <span class="bg-rosa-glow/20 text-rosa-fuerte px-3 py-1 rounded-full text-xs font-bold shadow-sm">
                        ${{ number_format($p->precio, 2) }}
                    </span>
                </div>
                <p class="text-gray-500 text-sm mb-4">{{ $p->descripcion }}</p>
            </div>

            <div class="border-t border-gray-50 pt-4 mt-2">
                <div class="flex justify-between items-end">
                    <div class="flex flex-col gap-1">
                        <span class="text-xs font-bold {{ $p->stock > 0 ? 'text-green-600' : 'text-red-500' }}">
                            <i class="bi bi-box-fill"></i> Stock: {{ $p->stock }}
                        </span>
                        <span class="text-xs font-bold text-yellow-600">
                            <i class="bi bi-hourglass-split"></i> Apartados: {{ $p->apartados ?? 0 }}
                        </span>
                    </div>
                    
                    @if(auth()->user()->rol != 'Cliente')
                    <div class="flex gap-3">
                        <a href="{{ route('productos.edit', $p->id) }}" class="text-blue-500 hover:text-blue-700">
                            <i class="bi bi-pencil-square text-lg"></i>
                        </a>
                        <form action="{{ route('productos.destroy', $p->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="text-red-400 hover:text-red-600">
                                <i class="bi bi-trash3 text-lg"></i>
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection