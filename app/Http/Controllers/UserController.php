<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Afficher le profil de l'utilisateur (avec son score total).
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        // Récupérer l'utilisateur actuellement connecté
        $user = auth()->user();

        $totalScore = $user->score; // Si le score est dans la colonne 'score'

        // Retourner la vue profile avec les données de l'utilisateur et du score
        return view('profile', compact('user', 'totalScore'));
    }
}
