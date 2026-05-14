@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    
    @if(auth()->user()->rol == 'Administrador' || auth()->user()->rol == 'Recepcionista')
        @if($citasPendientes->count() > 0)
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-8 rounded shadow-sm">
            <h3 class="text-yellow-800 font-bold mb-3"><i class="bi bi-calendar-exclamation"></i> Solicitudes de Citas Pendientes</h3>
            <div class="space-y-3">
                @foreach($citasPendientes as $pendiente)
                <div class="flex justify-between items-center bg-white p-4 rounded shadow-sm border border-yellow-100">
                    <div>
                        <p class="font-bold text-oscuro">{{ $pendiente->cliente->nombre }} solicita: {{ $pendiente->servicio }}</p>
                        <p class="text-sm text-gray-600">Para el día: <b>{{ $pendiente->fecha }}</b> a las <b>{{ $pendiente->hora }}</b></p>
                    </div>
                    <div class="flex gap-2">
                        <form action="{{ route('citas.aprobar', $pendiente->id) }}" method="POST">
                            @csrf @method('PATCH')
                            <button class="bg-green-500 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-green-600 shadow transition">Confirmar Cita</button>
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
            <i class="bi bi-calendar-check text-rosa-fuerte"></i> 
            {{ auth()->user()->rol == 'Cliente' ? 'Mi Historial de Citas' : 'Agenda Oficial' }}
        </h2>
        <a href="{{ route('citas.create') }}" class="bg-rosa-fuerte text-white px-5 py-2.5 rounded-lg shadow hover:bg-[#b87a80] transition font-semibold">
            <i class="bi bi-plus-lg mr-1"></i> {{ auth()->user()->rol == 'Cliente' ? 'Solicitar Nueva Cita' : 'Agendar Cita' }}
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border-t-[5px] border-rosa-fuerte overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-sm border-b border-gray-100">
                        @if(auth()->user()->rol != 'Cliente')
                        <th class="py-4 px-6 font-semibold">Cliente</th>
                        @endif
                        <th class="py-4 px-6 font-semibold">Servicio</th>
                        <th class="py-4 px-6 font-semibold">Fecha y Hora</th>
                        <th class="py-4 px-6 font-semibold">Estado</th>
                        @if(auth()->user()->rol != 'Cliente')
                        <th class="py-4 px-6 font-semibold text-center">Acciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($citas as $cita)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        @if(auth()->user()->rol != 'Cliente')
                        <td class="py-4 px-6 font-bold text-oscuro">{{ $cita->cliente->nombre }}</td>
                        @endif
                        <td class="py-4 px-6 text-gray-600">{{ $cita->servicio }}</td>
                        <td class="py-4 px-6 text-gray-600">
                            <span class="block font-semibold">{{ $cita->fecha }}</span>
                            <span class="text-xs text-gray-400">{{ $cita->hora }}</span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider 
                                {{ $cita->estado == 'Confirmada' ? 'bg-green-50 text-green-700 border-green-200' : 'bg-yellow-50 text-yellow-700 border-yellow-200' }} border">
                                {{ $cita->estado }}
                            </span>
                        </td>
                        
                        @if(auth()->user()->rol != 'Cliente')
                        <td class="py-4 px-6 text-center">
                            <form action="{{ route('citas.destroy', $cita->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button class="text-red-500 hover:text-red-700" onclick="return confirm('¿Cancelar cita?')">
                                    <i class="bi bi-x-circle-fill text-xl"></i>
                                </button>
                            </form>
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center text-gray-400">No hay citas en la agenda.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection