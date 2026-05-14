@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center">
    <div class="bg-white p-10 rounded-3xl shadow-xl border border-rosa-glow w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-playfair font-bold text-oscuro">Bienvenida</h1>
            <p class="text-gray-500 mt-2">Accede al sistema de Blanca Glow</p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r-xl shadow-sm" role="alert">
                <p class="font-bold">¡Registro Exitoso!</p>
                <p class="text-sm">{{ session('success') }}</p>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Correo Electrónico</label>
                <input type="email" name="email" required autofocus
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-rosa-fuerte focus:ring-4 focus:ring-rosa-glow/30 outline-none transition">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Contraseña</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-rosa-fuerte focus:ring-4 focus:ring-rosa-glow/30 outline-none transition">
            </div>

            <button type="submit" class="w-full bg-rosa-fuerte text-white py-4 rounded-xl font-bold text-lg shadow-lg hover:bg-[#b87a80] transition transform hover:scale-[1.02]">
                Entrar al Sistema
            </button>

            <div class="mt-8 text-center border-t border-gray-100 pt-6">
                <p class="text-gray-600">¿Eres nueva?</p>
                <a href="{{ route('register') }}" class="text-rosa-fuerte font-bold hover:underline">
                    Crea una cuenta de cliente aquí
                </a>
            </div>
        </form>
    </div>
</div>
@endsection