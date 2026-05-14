@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4">
    <div class="bg-white p-10 rounded-3xl shadow-2xl border border-rosa-glow w-full max-w-md">
        <h2 class="text-3xl font-playfair font-bold text-center text-oscuro mb-8">Crear Cuenta</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-bold text-gray-700 mb-2">Nombre</label>
                <input type="text" name="nombre" required value="{{ old('nombre') }}" class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-rosa-fuerte outline-none">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                <input type="email" name="email" required value="{{ old('email') }}" class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-rosa-fuerte outline-none @error('email') border-red-500 @enderror">
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold text-gray-700 mb-2">Teléfono</label>
                <input type="text" name="telefono" required value="{{ old('telefono') }}" class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-rosa-fuerte outline-none">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold text-gray-700 mb-2">País de Origen</label>
                <select name="pais" id="pais-selector" required class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-rosa-fuerte outline-none bg-white">
                    <option value="">Cargando países...</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold text-gray-700 mb-2">Contraseña</label>
                <input type="password" name="password" minlength="8" required class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-rosa-fuerte outline-none @error('password') border-red-500 @enderror">
                @error('password') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
            </div>

            <div class="mb-8">
                <label class="block text-sm font-bold text-gray-700 mb-2">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" minlength="8" required class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-rosa-fuerte outline-none">
            </div>

            <button type="submit" class="w-full bg-rosa-fuerte text-white py-3 rounded-xl font-bold shadow-lg hover:scale-105 transition">
                Registrarse ahora
            </button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch('https://restcountries.com/v3.1/all?fields=name')
            .then(res => res.json())
            .then(data => {
                const countries = data.map(c => c.name.common).sort();
                const selector = document.getElementById('pais-selector');
                selector.innerHTML = '<option value="">Selecciona tu país</option>';
                countries.forEach(c => selector.innerHTML += `<option value="${c}">${c}</option>`);
            });
    });
</script>
@endsection