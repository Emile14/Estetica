<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Models\Cliente;

Route::get('/ver-clientes', function () {
    $clientes = Cliente::all();
    return view('lista_clientes', compact('clientes'));
});
use App\Http\Controllers\ProductoController;

Route::resource('productos', ProductoController::class);
