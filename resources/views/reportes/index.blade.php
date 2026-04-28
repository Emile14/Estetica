@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
    
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-playfair font-bold text-oscuro flex items-center gap-3">
            <i class="bi bi-graph-up-arrow text-rosa-fuerte"></i> Corte de Caja y Finanzas
        </h2>
        <div class="flex gap-3">
            <button class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg shadow-sm hover:bg-gray-50 transition font-semibold flex items-center gap-2">
                <i class="bi bi-printer"></i> Imprimir
            </button>
            <a href="{{ route('reportes.create') }}" class="bg-emerald-600 text-white px-5 py-2 rounded-lg shadow-sm hover:bg-emerald-700 transition font-semibold flex items-center gap-2">
                <i class="bi bi-plus-circle"></i> Nueva Transacción
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-2xl shadow-sm border-t-[5px] border-dorado p-6 transition hover:shadow-md">
            <h6 class="text-gray-400 font-bold tracking-wider text-xs mb-2">TOTAL ACUMULADO</h6>
            <h3 class="text-4xl font-bold text-oscuro">${{ number_format($totalIngresos ?? 0, 2) }}</h3>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border-t-[5px] border-rosa-fuerte overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-sm border-b border-gray-100">
                        <th class="py-4 px-6 font-semibold">Fecha</th>
                        <th class="py-4 px-6 font-semibold">Concepto</th>
                        <th class="py-4 px-6 font-semibold">Atendido por</th>
                        <th class="py-4 px-6 font-semibold text-right">Monto ($)</th>
                        <th class="py-4 px-6 font-semibold text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($reportes as $reporte)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="py-4 px-6 text-gray-500">{{ \Carbon\Carbon::parse($reporte->fecha)->format('d/m/Y') }}</td>
                        <td class="py-4 px-6 font-bold text-oscuro">{{ $reporte->concepto }}</td>
                        <td class="py-4 px-6 text-gray-600">
                            <span class="bg-gray-100 px-3 py-1 rounded-full text-xs font-semibold">{{ $reporte->atendido_por }}</span>
                        </td>
                        <td class="py-4 px-6 font-bold text-emerald-600 text-right">${{ number_format($reporte->monto, 2) }}</td>
                        <td class="py-4 px-6 text-center">
                            <form action="{{ route('reportes.destroy', $reporte->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('¿Eliminar este registro?')"><i class="bi bi-trash3-fill text-lg"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-16 text-center text-gray-400">
                            <i class="bi bi-wallet2 text-5xl block mb-4 opacity-50"></i>
                            <p class="text-lg">Aún no hay transacciones registradas.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection