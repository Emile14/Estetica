@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-sm border-t-[5px] border-rosa-fuerte">
    <h2 class="text-3xl font-playfair font-bold text-oscuro mb-6">
        {{ auth()->user()->rol == 'Cliente' ? 'Solicitar Nueva Cita' : 'Agendar Cita Oficial' }}
    </h2>

    <form action="{{ route('citas.store') }}" method="POST">
        @csrf

        @if(auth()->user()->rol != 'Cliente')
            <div class="mb-4">
                <label class="block font-bold text-gray-700 mb-2">Cliente</label>
                <select name="cliente_id" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-rosa-fuerte outline-none" required>
                    <option value="">Selecciona un cliente...</option>
                    @foreach(\App\Models\Cliente::all() as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-bold text-gray-700 mb-2">Estado de la Cita</label>
                <select name="estado" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-rosa-fuerte outline-none" required>
                    <option value="Confirmada">Confirmada</option>
                    <option value="Pendiente">Pendiente</option>
                </select>
            </div>
        @endif

        <div class="mb-4">
            <label class="block font-bold text-gray-700 mb-2">Servicio</label>
            <select name="servicio" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-rosa-fuerte outline-none" required>
                <option value="">Selecciona un servicio...</option>
                @foreach(\App\Models\Servicior::all() as $servicio)
                    <option value="{{ $servicio->nombre }}">{{ $servicio->nombre }} - ${{ number_format($servicio->precio, 2) }}</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-8">
            <div>
                <label class="block font-bold text-gray-700 mb-2">Fecha</label>
                <input type="date" name="fecha" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-rosa-fuerte outline-none">
            </div>
            <div>
                <label class="block font-bold text-gray-700 mb-2">Hora</label>
                <input type="time" name="hora" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-rosa-fuerte outline-none">
            </div>
        </div>

        <button type="submit" class="w-full bg-rosa-fuerte text-white py-3 rounded-xl font-bold hover:scale-[1.02] transition shadow-md">
            {{ auth()->user()->rol == 'Cliente' ? 'Enviar Solicitud de Cita' : 'Guardar Cita' }}
        </button>
    </form>
</div>
@endsection