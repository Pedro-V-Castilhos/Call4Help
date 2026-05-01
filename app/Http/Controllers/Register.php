<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use App\Models\User;
use App\Models\Worker;
use Auth;
use Illuminate\Http\Request;

class Register extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        if ($request->isMethod('get')) {
            $sectors = Sector::all();
            return view('auth.register', compact('sectors'));
        }

        $validated = $request->validate([
            'name' => "required|string|max:255",
            'email' => "required|email|unique:users,email",
            'password' => "required|confirmed|min:8",
            'sector_id' => "nullable|exists:sectors,id",
        ], [
            "name.required" => "O campo nome é obrigatório.",
            "name.string" => "O campo nome deve ser textual.",
            "name.max" => "O campo nome deve conter no máximo 255 caracteres.",
            "email.required" => "O campo email é obrigatório.",
            "email.email" => "O campo email deve conter um endereço de email válido.",
            "email.unique" => "O email informado já está em uso.",
            "password.required" => "O campo senha é obrigatório.",
            "password.confirmed" => "A confirmação de senha não corresponde.",
            "password.min" => "A senha deve conter no mínimo 8 caracteres.",
            "sector_id.exists" => "O setor selecionado é inválido.",
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        if(isset($validated['sector_id'])) {
            Worker::create([
                'user_id' => $user->id,
                'sector_id' => $validated['sector_id'],
            ]);
        }

        Auth::login($user);
        return redirect('/')->with('success', 'Registro realizado com sucesso!');
    }
}
