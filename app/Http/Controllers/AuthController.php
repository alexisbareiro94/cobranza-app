<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register_view()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        try {
            $data = $request->validated();
            User::create($data);

            return redirect()
                ->route('login')
                ->with('success', 'Te haz registrado correctamente, ahora puedes iniciar sesión');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function login_view()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($data)) {
            return redirect()->route('login')->with('error', 'Ocurrió un error');
        }

        return redirect('/');
    }

    public function logout()
    {
        try {
            auth()->logout();
            return redirect()->route('login');
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(),);
        }
    }
}
