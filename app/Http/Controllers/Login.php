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
        ],[
            "email.required"=> "O campo de email é obrigatório.",
            "email.email"=> "O campo de email deve ser um endereço de email válido.",
            "password.required"=> "O campo de senha é obrigatório.",
        ]);

        if(Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Login realizado com sucesso!');
        }

        return back()->withErrors(['email'=> 'Email ou senha incorretos!'])->onlyInput('email');
    }
}
