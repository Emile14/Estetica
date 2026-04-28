@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('reportes.index') }}" class="text-gray-400 hover:text-emerald-600 transition duration-200">
            <i class="bi bi-arrow-left-circle-fill text-3xl"></i>
        </a>
        <h2 class="text-3xl font-playfair font-bold text-oscuro">Registrar Ingreso</h2>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border-t-[5px] border-emerald-500 p-8">
        <form action="{{ route('reportes.store') }}" method="POST">
            @csrf
            
            <div class="space-y-6">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Fecha de Venta</label>
                        <input type="date" name="fecha" required value="{{ date('Y-m-d') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Monto Cobrado ($)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-3 text-gray-500 font-bold">$</span>
                            <input type="number" step="0.01" name="monto" required
                                class="w-full pl-8 pr-4 py-3 rounded-lg border border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 outline-none transition" 
                                placeholder="0.00">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Concepto / Servicio Realizado</label>
                    <input type="text" name="concepto" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 outline-none transition" 
                        placeholder="Ej. Tinte + Corte de cabello">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Atendido por</label>
                    <select name="atendido_por" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 outline-none transition bg-white">
                        <option value="" disabled selected>Selecciona al estilista...</option>
                        <option value="Blanca">Blanca</option>
                        <option value="Otro Estilista">Otro Estilista</option>
                    </select>
                </div>

                <div class="pt-6 mt-6 border-t border-gray-100 flex justify-end gap-3">
                    <a href="{{ route('reportes.index') }}" class="px-6 py-2.5 rounded-lg font-semibold text-gray-600 hover:bg-gray-100 transition">Cancelar</a>
                    <button type="submit" class="bg-emerald-600 text-white px-6 py-2.5 rounded-lg font-semibold shadow-sm hover:bg-emerald-700 transition flex items-center gap-2">
                        <i class="bi bi-check-circle"></i> Guardar Ingreso
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection