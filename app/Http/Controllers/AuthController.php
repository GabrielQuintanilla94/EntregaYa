<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Mostrar la pantalla de Login
    public function index()
    {
        return view('login');
    }

    // Procesar el formulario
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Segmentación por roles:
            if (Auth::user()->rol === 'admin') {
                return redirect()->intended('/dashboard');
            } else {
                return redirect()->intended('/mis-entregas'); // Ruta futura para el conductor
            }
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden.',
        ]);
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }


    // Mostrar la pantalla de Registro
    public function create()
    {
        return view('registro');
    }

    // Procesar el registro y guardar en base de datos
    public function register(Request $request)
    {
        // 1. Validar que nos envíen todos los datos correctamente
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        // 2. Crear al usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Encriptamos la contraseña por seguridad
            'rol' => 'conductor' // Le asignamos este rol por defecto basado en tu lógica actual
        ]);

        // 3. Iniciar sesión automáticamente después de registrarse
        Auth::login($user);

        // 4. Redirigir a su panel correspondiente
        return redirect('/mis-entregas'); 
    }
}