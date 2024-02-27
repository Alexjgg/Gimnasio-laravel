<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $originalName = $request->input('name');

        $cleanedName = filter_var($originalName, FILTER_SANITIZE_STRING);
        if ($originalName != $cleanedName) {
            return back()->withErrors(['error' => 'El campo name contiene caracteres especiales no permitidos.'])->withInput();
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            // Intentar crear un nuevo usuario
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);

            // Si se crea el usuario correctamente, redirigir a alguna página de éxito
            auth()->login($user);
            return redirect('/')->with('success', '¡Registro exitoso!');
        } catch (\Exception $e) {
            // Si hay un error, devolver a la vista del formulario con errores y datos anteriores
            return back()->withErrors(['error' => 'Error al crear el usuario. Por favor, inténtalo de nuevo.'])->withInput();
        }

    }
    public function edit($id)
    {
        if (Auth::user()->hasRole('admin') || Auth::user()->id == $id) {
            $user = User::findOrFail($id);
            return view('auth.editar', compact('user'));
        } else {
            return view('inicio');
        }

    }
    public function update(Request $request, $id)
    {
        if (Auth::user()->hasRole('admin') || Auth::user()->id == $id) {
            $originalName = $request->input('name');

            $cleanedName = filter_var($originalName, FILTER_SANITIZE_STRING);
            if ($originalName != $cleanedName) {
                return back()->withErrors(['error' => 'El campo name contiene caracteres especiales no permitidos.'])->withInput();
            }
            //Validar que es admin para cambiar el rol
            if ($request->input('role') && !Auth::user()->hasRole('admin')) {
                return redirect()->route('inicio');
            }

            // Validar la request para la actualización
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'nullable|string|min:8|confirmed',
                'role' => 'required|in:user,entrenador,admin',
            ]);

            try {
                $user = User::findOrFail($id);

                if ($request->input('role')) {
                    $user->role = $request->input('role');
                }
                // Actualizar los campos del usuario
                $user->update([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => $request->has('password') ? Hash::make($request->input('password')) : $user->password,
                    'role' => $user->role,
                ]);

                return redirect()->route('inicio')->with('success', 'Usuario actualizado correctamente');

            } catch (\Exception $e) {

                return back()->withErrors(['error' => 'Error al actualizar el usuario. Por favor, inténtalo de nuevo.'])->withInput();
            }
        } else {
            return view('inicio');
        }
    }
}
