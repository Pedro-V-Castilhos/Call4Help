<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class Login extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $credentials = $request->validate([
            'email' => "required|email",
            'password' => "required",
        ]);

        if(Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Login realizado com sucesso!');
        }

        return back()->withErrors(['email'=> 'Email ou senha incorretos!'])->onlyInput('email');
    }
}
