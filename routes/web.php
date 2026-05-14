<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ReporteFinancieroController;
use App\Http\Controllers\ClienteController;

// Raíz del sitio
Route::get('/', function () {
    return Auth::check() ? redirect()->route('home') : view('auth.login');
});

Auth::routes();

// Rutas protegidas (Requieren inicio de sesión)
Route::middleware(['auth'])->group(function () {
    
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/salir', function () {
        Auth::logout();
        return redirect('/');
    })->name('salir');

    // ==========================================
    // RUTAS PÚBLICAS (Para Clientes, Admin y Recepción)
    // ==========================================
    
    // Catálogo e Inventario
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::post('/productos/{producto}/solicitar', [ProductoController::class, 'solicitar'])->name('productos.solicitar');

    // Citas (Ver agenda propia y crear nueva)
    Route::get('/citas', [CitaController::class, 'index'])->name('citas.index');
    Route::get('/citas/create', [CitaController::class, 'create'])->name('citas.create');
    Route::post('/citas', [CitaController::class, 'store'])->name('citas.store');


    // ==========================================
    // RUTAS PRIVADAS (Solo Administrador)
    // ==========================================
    Route::middleware(['role:Administrador'])->group(function () {
        Route::resource('usuarios', UserController::class);
    });


    // ==========================================
    // RUTAS DE GESTIÓN (Admin y Recepcionista)
    // ==========================================
    Route::middleware(['role:Administrador,Recepcionista'])->group(function () {
        
        // Rutas para aprobar/rechazar solicitudes de clientes
        Route::patch('/citas/{cita}/aprobar', [CitaController::class, 'aprobar'])->name('citas.aprobar');
        Route::patch('/reservas/{reserva}/aprobar', [ProductoController::class, 'aprobarReserva'])->name('reservas.aprobar');
        Route::delete('/reservas/{reserva}/rechazar', [ProductoController::class, 'rechazarReserva'])->name('reservas.rechazar');
        
        // El resto de funciones CRUD para Productos y Citas (Editar, Eliminar, etc)
        Route::resource('productos', ProductoController::class)->except(['index', 'show']);
        Route::resource('citas', CitaController::class)->except(['index', 'create', 'store', 'show']);
        
        // Módulos Exclusivos del personal
        Route::resource('reportes', ReporteFinancieroController::class);
        Route::resource('clientes', ClienteController::class);
    });
});