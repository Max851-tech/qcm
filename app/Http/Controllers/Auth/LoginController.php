<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Middleware\ValidateSignature;

#[Middleware(ValidateSignature::class)]
class SomeController4 { }

class LoginController extends Controller
{
    // Afficher le formulaire de connexion
    public function showLoginForm()
    {
        return view('auth.login'); // Retourne la vue pour afficher le formulaire de connexion
    }

    // Tentative de connexion de l'utilisateur
    public function login(Request $request)
    {
        // Validation des données d'entrée
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Tentative de connexion avec les données validées
        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']], $request->filled('remember'))) {
            // Si la connexion réussit, redirection vers le tableau de bord ou la page principale
            return redirect()->intended('dashboard'); // Ou redirigez vers la page que vous préférez
        }

        // Si l'authentification échoue, retourner un message d'erreur
        return back()->withErrors([
            'email' => 'Ces informations d\'identification ne correspondent pas à nos enregistrements.',
        ]);
    }

    // Déconnexion de l'utilisateur
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login'); // Ou redirigez vers une autre page après la déconnexion
    }
}



