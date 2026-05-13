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

// Rutas protegidas
Route::middleware(['auth'])->group(function () {
    
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // ESTA ES LA RUTA QUE FALTABA
    Route::get('/salir', function () {
        Auth::logout();
        return redirect('/');
    })->name('salir');

    // Usuarios (Solo Administrador)
    Route::middleware(['role:Administrador'])->group(function () {
        Route::resource('usuarios', UserController::class);
    });

    // Otros Módulos (Admin y Recepcionista)
    Route::middleware(['role:Administrador,Recepcionista'])->group(function () {
        Route::resource('citas', CitaController::class);
        Route::resource('productos', ProductoController::class);
        Route::resource('reportes', ReporteFinancieroController::class);
        Route::resource('clientes', ClienteController::class);
    });
});