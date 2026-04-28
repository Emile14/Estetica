<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Blanca Glow | Sistema de Gestión</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-rosa-glow/20 font-sans text-oscuro antialiased min-h-screen">
    
    <nav class="bg-white border-b-[3px] border-rosa-fuerte shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                
                <a href="{{ url('/home') }}" class="flex items-center gap-2 text-2xl font-bold font-playfair text-oscuro">
                    <i class="bi bi-stars text-dorado"></i> Blanca Glow
                </a>

                <div class="hidden md:flex items-center space-x-6 pl-8">
                    @auth
                        <a href="{{ route('clientes.index') }}" class="text-oscuro font-semibold hover:text-rosa-fuerte transition duration-200">
                            <i class="bi bi-people-fill mr-1"></i> Clientes
                        </a>
                        <a href="{{ route('citas.index') }}" class="text-oscuro font-semibold hover:text-rosa-fuerte transition duration-200">
                            <i class="bi bi-calendar-heart mr-1"></i> Agenda
                        </a>
                        <a href="{{ route('productos.index') }}" class="text-oscuro font-semibold hover:text-rosa-fuerte transition duration-200">
                            <i class="bi bi-box-seam mr-1"></i> Inventario
                        </a>

                        @if(auth()->user()->rol == 'Administrador')
                            <div class="h-6 w-px bg-gray-200 mx-2"></div>
                            <a href="{{ route('usuarios.index') }}" class="text-blue-600 font-semibold hover:text-blue-800 transition duration-200">
                                <i class="bi bi-person-badge mr-1"></i> Personal
                            </a>
                            <a href="{{ route('reportes.index') }}" class="text-emerald-600 font-semibold hover:text-emerald-800 transition duration-200">
                                <i class="bi bi-graph-up-arrow mr-1"></i> Finanzas
                            </a>
                        @endif
                    @endauth
                </div>

                <div class="hidden md:flex items-center">
                    @auth
                        <div class="relative group">
                            <button class="flex items-center gap-2 text-oscuro font-bold focus:outline-none">
                                {{ Auth::user()->nombre }}
                                <span class="bg-dorado text-white text-xs px-3 py-1 rounded-full shadow-sm">{{ Auth::user()->rol }}</span>
                            </button>
                            <div class="absolute right-0 w-48 mt-2 bg-white border border-gray-100 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <a href="{{ route('salir') }}" class="block px-4 py-3 text-sm font-bold text-red-600 hover:bg-gray-50 rounded-lg">
                                    <i class="bi bi-box-arrow-right mr-2"></i> Cerrar Sesión
                                </a>
                            </div>
                        </div>
                    @endauth
                </div>

            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        @yield('content')
    </main>

</body>
</html>