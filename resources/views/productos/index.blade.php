@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    @if(auth()->user()->rol == 'Administrador' || auth()->user()->rol == 'Recepcionista')
        @if($reservasPendientes->count() > 0)
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-8 rounded shadow-sm">
            <h3 class="text-yellow-800 font-bold mb-2"><i class="bi bi-bell-fill"></i> Solicitudes de Productos Pendientes</h3>
            <div class="space-y-3">
                @foreach($reservasPendientes as $reserva)
                <div class="flex justify-between items-center bg-white p-3 rounded shadow-sm">
                    <p class="text-sm">El cliente <b>{{ $reserva->cliente->nombre }}</b> solicitó apartar <b>{{ $reserva->producto->nombre }}</b>.</p>
                    <div class="flex gap-2">
                        <form action="{{ route('reservas.aprobar', $reserva->id) }}" method="POST">
                            @csrf @method('PATCH')
                            <button class="bg-green-500 text-white px-3 py-1 rounded text-xs font-bold hover:bg-green-600">Aprobar</button>
                        </form>
                        <form action="{{ route('reservas.rechazar', $reserva->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 rounded text-xs font-bold hover:bg-red-600">Rechazar</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    @endif

    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-playfair font-bold text-oscuro flex items-center gap-3">
            <i class="bi bi-box-seam text-rosa-fuerte"></i> Catálogo de Productos
        </h2>
        @if(auth()->user()->rol == 'Administrador' || auth()->user()->rol == 'Recepcionista')
        <a href="{{ route('productos.create') }}" class="bg-rosa-fuerte text-white px-5 py-2.5 rounded-lg shadow hover:bg-[#b87a80] transition">Nuevo Producto</a>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($productos as $producto)
        <div class="bg-white rounded-xl shadow p-6 border-t-4 border-rosa-fuerte">
            <h3 class="font-bold text-xl mb-2 text-oscuro">{{ $producto->nombre }}</h3>
            <p class="text-gray-500 text-sm mb-4">{{ $producto->descripcion }}</p>
            <div class="flex justify-between items-center mb-4">
                <span class="text-2xl font-bold text-rosa-fuerte">${{ number_format($producto->precio, 2) }}</span>
                <span class="px-2 py-1 bg-gray-100 rounded-full text-xs font-bold {{ $producto->stock > 0 ? 'text-green-600' : 'text-red-500' }}">
                    Stock: {{ $producto->stock }}
                </span>
            </div>

            @if(auth()->user()->rol == 'Cliente')
                <form action="{{ route('productos.solicitar', $producto->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-oscuro text-white py-2 rounded-lg font-bold hover:bg-gray-800 transition disabled:opacity-50" {{ $producto->stock <= 0 ? 'disabled' : '' }}>
                        {{ $producto->stock > 0 ? 'Solicitar Apartado' : 'Agotado' }}
                    </button>
                </form>
            @else
                <div class="flex gap-2 border-t pt-4 mt-2">
                    <a href="{{ route('productos.edit', $producto->id) }}" class="flex-1 bg-blue-50 text-blue-600 text-center py-2 rounded font-bold hover:bg-blue-100">Editar</a>
                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="flex-1">
                        @csrf @method('DELETE')
                        <button class="w-full bg-red-50 text-red-600 py-2 rounded font-bold hover:bg-red-100">Borrar</button>
                    </form>
                </div>
            @endif
        </div>
        @endforeach
    </div>
</div>
@endsection