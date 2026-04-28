<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\ServiciorController;
use App\Http\Controllers\ReporteFinancieroController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/salir', function () { Auth::logout(); return redirect('/login'); })->name('salir');

    // RUTAS DEL ADMINISTRADOR
    Route::middleware(['role:Administrador'])->group(function () {
        Route::resource('usuarios', UserController::class);
        Route::resource('servicios', ServiciorController::class);
        Route::resource('reportes', ReporteFinancieroController::class);
    });

    // RUTAS OPERATIVAS (Admin y Recepcionista)
    Route::middleware(['role:Administrador,Recepcionista'])->group(function () {
        Route::resource('clientes', ClienteController::class);
        Route::resource('productos', ProductoController::class);
        Route::resource('citas', CitaController::class);
    });
});