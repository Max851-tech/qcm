<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Routing\Middleware\ValidateSignature;

#[Middleware(ValidateSignature::class)]
class SomeController5 { }

class RegisteredUserController extends Controller
{
    // Afficher le formulaire d'inscription
    public function create()
    {
        return view('auth.register');
    }

    // Soumettre le formulaire d'inscription
    public function store(Request $request)
    {
        // Validation des données d'inscription
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        // Création de l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Déclenchement de l'événement d'enregistrement
        event(new Registered($user));

        // Connexion automatique de l'utilisateur après l'inscription
        auth()->login($user);

        // Redirection après inscription réussie
        return redirect('/dashboard');
    }
}
