@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    
    @if(auth()->user()->rol != 'Cliente' && $citasPendientes->count() > 0)
        <div class="bg-yellow-50 border-l-8 border-yellow-400 p-6 mb-10 rounded-2xl shadow-sm">
            <h3 class="text-yellow-800 font-bold text-xl mb-4"><i class="bi bi-bell-fill"></i> Solicitudes de Citas por Aprobar</h3>
            <div class="grid gap-4">
                @foreach($citasPendientes as $p)
                <div class="bg-white p-4 rounded-xl shadow-sm flex justify-between items-center border border-yellow-100">
                    <div>
                        <p class="font-bold text-oscuro">{{ $p->cliente->nombre }}</p>
                        <p class="text-sm text-gray-500">{{ $p->servicio }} | {{ $p->fecha }} a las {{ $p->hora }}</p>
                    </div>
                    <form action="{{ route('citas.aprobar', $p->id) }}" method="POST">
                        @csrf @method('PATCH')
                        <button class="bg-green-500 text-white px-4 py-2 rounded-lg font-bold hover:bg-green-600 transition">Aprobar</button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-playfair font-bold text-oscuro">Agenda Blanca Glow</h2>
        <a href="{{ route('citas.create') }}" class="bg-rosa-fuerte text-white px-6 py-3 rounded-xl font-bold shadow-md hover:bg-[#b87a80] transition">
            + {{ auth()->user()->rol == 'Cliente' ? 'Solicitar Cita' : 'Agendar Nueva' }}
        </a>
    </div>

    <div class="bg-white rounded-3xl shadow-sm overflow-hidden border border-gray-100">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                <tr>
                    <th class="p-5">Servicio</th>
                    <th class="p-5">Fecha y Hora</th>
                    <th class="p-5">Estado</th>
                    <th class="p-5 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($citas as $c)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-5 font-bold text-oscuro">{{ $c->servicio }}</td>
                    <td class="p-5 text-gray-600">{{ $c->fecha }} | {{ $c->hora }}</td>
                    <td class="p-5">
                        <span class="px-3 py-1 rounded-full text-xs font-bold {{ $c->estado == 'Confirmada' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ $c->estado }}
                        </span>
                    </td>
                    <td class="p-5 text-center">
                        <form action="{{ route('citas.destroy', $c->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="text-red-400 hover:text-red-600"><i class="bi bi-trash3-fill"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection