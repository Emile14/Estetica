<?php
use Illuminate\Support\Facades\Auth; // <-- Asegúrate de poner esto hasta arriba con los demás "use"
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UserController; // <-- Importamos tu nuevo controlador

// Página de inicio (Pública)
Route::get('/', function () {
    return view('welcome');
});

// -------------------------------------------------------------
// RUTAS PROTEGIDAS POR ROLES (Tu cadenero en acción)
// -------------------------------------------------------------

// GRUPO 1: Solo el Administrador (Pedro Sánchez) puede entrar aquí
Route::middleware(['role:Administrador'])->group(function () {
    // Rutas para gestionar empleados/usuarios
    Route::resource('usuarios', UserController::class);
});

// GRUPO 2: Administrador Y Recepcionista (Carlos Ruiz) pueden entrar aquí
// Fíjate cómo separamos los roles permitidos por una coma
Route::middleware(['role:Administrador,Recepcionista'])->group(function () {
    // Rutas para gestionar Clientes
    Route::resource('clientes', ClienteController::class);
    
    // Rutas para el Inventario
    Route::resource('productos', ProductoController::class);
});


// RUTA TEMPORAL PARA SIMULAR LOGIN
Route::get('/entrar/{id}', function ($id) {
    Auth::loginUsingId($id);
    return redirect('/usuarios');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/salir', function () {
    Auth::logout();
    return redirect('/login');
});