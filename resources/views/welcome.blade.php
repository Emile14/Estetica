<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Blanca Glow</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=playfair-display:500|instrument-sans:400,500" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Instrument Sans', sans-serif;
                background-color: #fff5f5; /* Tono rosado muy claro de la captura */
            }
            .brand-font {
                font-family: 'Playfair Display', serif;
            }
        </style>
    </head>
    <body class="antialiased border-t-4 border-[#fce4e4]">
        <!-- Header con Logo -->
        <header class="bg-white py-6 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 flex justify-center items-center">
                <div class="flex items-center gap-2">
                    <span class="text-[#d4af37] text-2xl">✦</span>
                    <h1 class="text-3xl brand-font text-[#2d2d2d]">Blanca Glow</h1>
                </div>
            </div>
        </header>

        <!-- Contenido Principal -->
        <main class="min-h-[70vh] flex flex-col items-center justify-center p-6">
            <div class="text-center mb-12">
                <p class="text-[#706f6c] uppercase tracking-widest text-sm mb-2 font-medium">Bienvenida a tu espacio de belleza</p>
                <h2 class="text-4xl brand-font text-[#1b1b18]">Reserva tu Experiencia</h2>
            </div>

            <div class="flex flex-col sm:flex-row gap-6 w-full max-w-md">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="flex-1 text-center bg-[#1b1b18] text-white py-4 rounded-sm hover:bg-black transition duration-300 font-medium">
                            Ir al Panel de Control
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="flex-1 text-center border-2 border-[#1b1b18] text-[#1b1b18] py-4 rounded-sm hover:bg-[#1b1b18] hover:text-white transition duration-300 font-medium uppercase text-xs tracking-widest">
                            Iniciar Sesión
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="flex-1 text-center bg-[#1b1b18] text-white py-4 rounded-sm hover:bg-black transition duration-300 font-medium uppercase text-xs tracking-widest">
                                Registrarse
                            </a>
                        @endif
                    @endauth
                @endif
            </div>

            <!-- Footer decorativo -->
            <footer class="mt-20 text-[#a1a09a] text-[11px] uppercase tracking-[0.2em]">
                Cuidado de la piel • Estética Avanzada • Bienestar
            </footer>
        </main>
    </body>
</html>