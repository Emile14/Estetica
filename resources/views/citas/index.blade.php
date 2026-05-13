@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">

    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-playfair font-bold text-oscuro flex items-center gap-3">
            <i class="bi bi-calendar-heart-fill text-rosa-fuerte"></i> Agenda de Citas
        </h2>
        <a href="{{ route('citas.create') }}" class="bg-rosa-fuerte text-white px-5 py-2.5 rounded-lg shadow-sm hover:bg-[#b87a80] transition font-semibold flex items-center gap-2">
            <i class="bi bi-calendar-plus"></i> Agendar Cita
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 px-5 py-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl flex items-center gap-2">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border-t-[5px] border-rosa-fuerte overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-sm border-b border-gray-100">
                        <th class="py-4 px-6 font-semibold">Cliente</th>
                        <th class="py-4 px-6 font-semibold">Servicio</th>
                        <th class="py-4 px-6 font-semibold">Fecha y Hora</th>
                        <th class="py-4 px-6 font-semibold">Estado</th>
                        <th class="py-4 px-6 font-semibold text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($citas as $cita)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="py-4 px-6 font-bold text-oscuro">
                            {{ $cita->cliente->nombre ?? 'Sin cliente' }}
                        </td>
                        <td class="py-4 px-6">
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-semibold border border-gray-200">
                                {{ $cita->servicio ?? 'Sin servicio' }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-gray-600">
                            {{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}
                            <span class="text-gray-400 text-sm ml-1">{{ $cita->hora }}</span>
                        </td>
                        <td class="py-4 px-6">
                            @php
                                $colores = [
                                    'Pendiente'  => 'bg-amber-100 text-amber-700',
                                    'Confirmada' => 'bg-emerald-100 text-emerald-700',
                                    'Cancelada'  => 'bg-red-100 text-red-700',
                                    'Completada' => 'bg-blue-100 text-blue-700',
                                ];
                                $color = $colores[$cita->estado] ?? 'bg-gray-100 text-gray-700';
                            @endphp
                            <span class="{{ $color }} px-3 py-1 rounded-full text-xs font-bold">
                                {{ $cita->estado ?? 'Pendiente' }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <a href="{{ route('citas.edit', $cita->id) }}"
                                class="text-blue-500 hover:text-blue-700 mx-2 inline-block">
                                <i class="bi bi-pencil-square text-xl"></i>
                            </a>
                            <form action="{{ route('citas.destroy', $cita->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('¿Eliminar esta cita?')"
                                    class="text-red-500 hover:text-red-700 mx-2">
                                    <i class="bi bi-x-circle-fill text-xl"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center text-gray-400">
                            <i class="bi bi-calendar-x text-5xl block mb-4 opacity-50"></i>
                            <p class="text-lg">No hay citas programadas.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection