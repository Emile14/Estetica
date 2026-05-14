<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Cliente;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct() { $this->middleware('guest'); }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telefono' => ['required', 'string', 'max:15'],
            'pais' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'password.min' => 'Mínimo 8 dígitos de contraseña.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);
    }

    // SOBREESCRIBIMOS EL MÉTODO DE LARAVEL PARA REDIRIGIR AL LOGIN
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // En lugar de iniciar sesión automáticamente, lo mandamos al login con un mensaje
        return redirect()->route('login')->with('success', '¡Registro exitoso! Por favor inicia sesión con tu nueva cuenta.');
    }

    protected function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $user = User::create([
                'nombre' => $data['nombre'],
                'email' => $data['email'],
                'telefono' => $data['telefono'],
                'pais' => $data['pais'],
                'password' => Hash::make($data['password']),
                'rol' => 'Cliente',
            ]);

            Cliente::create([
                'user_id' => $user->id,
                'nombre' => $data['nombre'],
                'email' => $data['email'],
                'telefono' => $data['telefono'],
                'pais' => $data['pais'],
            ]);

            return $user;
        });
    }
}