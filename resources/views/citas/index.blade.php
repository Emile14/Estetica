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
                        <td class="py-4 px-6 font-bold text-oscuro">{{ $cita->cliente->nombre ?? 'Cliente' }}</td>
                        <td class="py-4 px-6"><span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-semibold border border-gray-200">{{ $cita->servicio ?? 'Servicio' }}</span></td>
                        <td class="py-4 px-6 text-gray-600">{{ $cita->fecha }} <span class="text-gray-400 text-sm ml-1">{{ $cita->hora }}</span></td>
                        <td class="py-4 px-6"><span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-xs font-bold">{{ $cita->estado ?? 'Pendiente' }}</span></td>
                        <td class="py-4 px-6 text-center">
                            <form action="{{ route('citas.destroy', $cita->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700"><i class="bi bi-x-circle-fill text-xl"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="py-12 text-center text-gray-400">No hay citas programadas.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection