<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Blanca Glow | Inicio</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=playfair-display:500,600,700|instrument-sans:400,500,600" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Instrument Sans', sans-serif;
                background-color: #fff5f5; /* Tono rosado muy claro */
            }
            .font-playfair {
                font-family: 'Playfair Display', serif;
            }
        </style>
    </head>
    <body class="antialiased border-t-[6px] border-[#d4af37]"> 
        
        <header class="bg-white/80 backdrop-blur-md py-5 shadow-sm fixed w-full top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 flex justify-center items-center">
                <div class="flex items-center gap-3">
                    <span class="text-[#d4af37] text-3xl">✦</span>
                    <h1 class="text-3xl font-playfair font-bold text-[#2d2d2d] tracking-wide">Blanca Glow</h1>
                </div>
            </div>
        </header>

        <main class="min-h-screen flex flex-col items-center justify-center p-6 pt-24 relative overflow-hidden">
            
            <div class="absolute w-96 h-96 bg-[#fce4e4] rounded-full blur-3xl -z-10 opacity-60 top-1/4"></div>

            <div class="text-center mb-12 max-w-2xl z-10">
                <p class="text-[#b87a80] uppercase tracking-[0.3em] text-sm mb-4 font-bold">Bienvenida a tu espacio de belleza</p>
                <h2 class="text-5xl md:text-6xl font-playfair font-bold text-[#1b1b18] leading-tight mb-6">
                    Reserva tu <span class="italic text-[#d4af37]">Experiencia</span>
                </h2>
                <p class="text-gray-500 text-lg md:px-12">
                    Accede a nuestro portal exclusivo para agendar tu próxima cita, descubrir nuestros productos y gestionar tus servicios.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 w-full max-w-md justify-center z-10">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('home') }}" class="w-full text-center bg-[#b87a80] border-2 border-[#b87a80] text-white py-4 px-8 rounded-full shadow-lg hover:bg-[#a3696e] hover:border-[#a3696e] hover:-translate-y-1 transition duration-300 font-bold uppercase tracking-wider text-sm flex justify-center items-center gap-2">
                            Ir al Panel de Control <i class="bi bi-arrow-right"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="flex-1 text-center bg-white border-2 border-[#1b1b18] text-[#1b1b18] py-4 px-6 rounded-full shadow-sm hover:bg-[#1b1b18] hover:text-white transition duration-300 font-bold uppercase tracking-wider text-xs">
                            Iniciar Sesión
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="flex-1 text-center bg-[#1b1b18] border-2 border-[#1b1b18] text-white py-4 px-6 rounded-full shadow-lg hover:bg-black transition duration-300 font-bold uppercase tracking-wider text-xs">
                                Registrarse
                            </a>
                        @endif
                    @endauth
                @endif
            </div>

            <footer class="absolute bottom-8 text-[#a1a09a] text-[10px] sm:text-xs uppercase tracking-[0.2em] flex flex-col items-center gap-3">
                <span class="text-[#d4af37] text-lg">✦</span>
                <p class="text-center">Cuidado de la piel <span class="mx-2">•</span> Estética Avanzada <span class="mx-2">•</span> Bienestar</p>
            </footer>

        </main>

    </body>
</html>