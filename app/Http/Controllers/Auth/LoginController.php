<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if ($user) {

            $passwordMatch = \Hash::check($credentials['password'], $user->password);
            if ($passwordMatch) {
                // Autenticación exitosa
                Auth::login($user);
                $request->session()->regenerate();
                return redirect()->intended('/');
            }
        }

        return back()->withErrors(['email' => 'Las credenciales proporcionadas no son válidas']);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
