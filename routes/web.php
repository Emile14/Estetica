<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;

// Página de inicio
Route::get('/', function () {
    return view('welcome');
});

// Rutas para Clientes
Route::resource('clientes', ClienteController::class);

// Rutas para Productos
Route::resource('productos', ProductoController::class);