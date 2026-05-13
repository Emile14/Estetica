@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12">
    <div class="bg-white p-10 rounded-3xl shadow-xl border border-rosa-glow w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-playfair font-bold text-oscuro">Únete a Nosotras</h1>
            <p class="text-gray-500 mt-2">Crea tu cuenta de cliente en Blanca Glow</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nombre Completo</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}" required autofocus
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-rosa-fuerte focus:ring-4 focus:ring-rosa-glow/30 outline-none transition">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Correo Electrónico</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-rosa-fuerte focus:ring-4 focus:ring-rosa-glow/30 outline-none transition">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Teléfono</label>
                <input type="text" name="telefono" value="{{ old('telefono') }}" required placeholder="Ej. 3312345678"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-rosa-fuerte focus:ring-4 focus:ring-rosa-glow/30 outline-none transition">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Contraseña</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-rosa-fuerte focus:ring-4 focus:ring-rosa-glow/30 outline-none transition">
            </div>

            <div class="mb-8">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-rosa-fuerte focus:ring-4 focus:ring-rosa-glow/30 outline-none transition">
            </div>

            <button type="submit" class="w-full bg-[#1b1b18] text-white py-4 rounded-xl font-bold text-lg shadow-lg hover:bg-black transition transform hover:scale-[1.02]">
                Registrarme como Cliente
            </button>

            <div class="mt-6 text-center">
                <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-rosa-fuerte transition">
                    ¿Ya tienes cuenta? Inicia sesión
                </a>
            </div>
        </form>
    </div>
</div>
@endsection