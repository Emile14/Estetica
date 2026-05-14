@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">

    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('citas.index') }}" class="text-gray-400 hover:text-rosa-fuerte transition duration-200">
            <i class="bi bi-arrow-left-circle-fill text-3xl"></i>
        </a>
        <h2 class="text-3xl font-playfair font-bold text-oscuro">Editar Cita</h2>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border-t-[5px] border-rosa-fuerte p-8">
        <form action="{{ route('citas.update', $cita->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="space-y-6">

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Cliente</label>
                    <select name="cliente_id" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-rosa-fuerte focus:ring-4 focus:ring-rosa-glow/50 outline-none transition bg-white">
                        <option value="" disabled>Selecciona un cliente...</option>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}"
                                {{ $cita->cliente_id == $cliente->id ? 'selected' : '' }}>
                                {{ $cliente->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('cliente_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Servicio</label>
                    <select name="servicio" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-rosa-fuerte focus:ring-4 focus:ring-rosa-glow/50 outline-none transition bg-white">
                        <option value="" disabled>Elige el servicio...</option>
                        @foreach([
                            'Corte de Cabello',
                            'Tinte / Coloración',
                            'Manicura / Pedicura',
                            'Maquillaje',
                            'Peinado',
                            'Tratamiento Capilar'
                        ] as $servicio)
                            <option value="{{ $servicio }}"
                                {{ $cita->servicio == $servicio ? 'selected' : '' }}>
                                {{ $servicio }}
                            </option>
                        @endforeach
                    </select>
                    @error('servicio')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Fecha</label>
                        <input type="date" name="fecha" required
                            value="{{ $cita->fecha }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-rosa-fuerte focus:ring-4 focus:ring-rosa-glow/50 outline-none transition">
                        @error('fecha')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Hora</label>
                        <input type="time" name="hora" required
                            value="{{ $cita->hora }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-rosa-fuerte focus:ring-4 focus:ring-rosa-glow/50 outline-none transition">
                        @error('hora')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Estado</label>
                    <select name="estado" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-rosa-fuerte focus:ring-4 focus:ring-rosa-glow/50 outline-none transition bg-white">
                        @foreach(['Pendiente', 'Confirmada', 'Cancelada', 'Completada'] as $estado)
                            <option value="{{ $estado }}"
                                {{ $cita->estado == $estado ? 'selected' : '' }}>
                                {{ $estado }}
                            </option>
                        @endforeach
                    </select>
                    @error('estado')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-6 mt-6 border-t border-gray-100 flex justify-end gap-3">
                    <a href="{{ route('citas.index') }}"
                        class="px-6 py-2.5 rounded-lg font-semibold text-gray-600 hover:bg-gray-100 transition">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="bg-rosa-fuerte text-white px-6 py-2.5 rounded-lg font-semibold shadow-sm hover:bg-[#b87a80] transition flex items-center gap-2">
                        <i class="bi bi-check-circle"></i> Guardar Cambios
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection