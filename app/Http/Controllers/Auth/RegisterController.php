<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Cliente; // IMPORTANTE: Agrega esta línea
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB; // IMPORTANTE: Agrega esta línea

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telefono' => ['required', 'string', 'max:15'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Crea una nueva instancia de usuario y un registro de cliente simultáneo.
     */
    protected function create(array $data)
    {
        // Usamos una transacción para que, si algo falla, no se cree uno sin el otro
        return DB::transaction(function () use ($data) {
            
            // 1. Crear el usuario para que pueda iniciar sesión
            $user = User::create([
                'nombre' => $data['nombre'],
                'email' => $data['email'],
                'telefono' => $data['telefono'],
                'password' => Hash::make($data['password']),
                'rol' => 'Cliente',
            ]);

            // 2. Crear automáticamente la ficha en la tabla de clientes
            // para que aparezca en la lista de la administración
            Cliente::create([
                'nombre' => $data['nombre'],
                'email' => $data['email'],
                'telefono' => $data['telefono'],
            ]);

            return $user;
        });
    }
}