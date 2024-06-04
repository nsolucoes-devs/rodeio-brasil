<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Rules\Recaptcha;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function index(): mixed
    {
        return Auth::check() ? redirect()->route('admin.index') : view('auth.login');
    }

    /**
     * @throws ValidationException
     */
    public function authenticate(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'E-mail ou senha incorretos.',
            ])->withInput();
        }

        $user = Auth::user();

//        if (!$user->active || $user->role == 'delivery_man') {
//            Auth::logout();
//            request()->session()->invalidate();
//            request()->session()->regenerateToken();
//
//            return back()->withErrors([
//                'email' => ['Usuário desativado. Procure um administrador.'],
//            ])->withInput();
//        }

        $request->session()->regenerate();

        return redirect()->intended('dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
