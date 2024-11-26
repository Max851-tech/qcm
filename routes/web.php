<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\QuestionController;  // Importation du contrôleur

// Route principale
Route::get('/', function () {
    return view('welcome');
});

// Route pour tester la connexion à la base de données
Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return 'Connexion réussie à la base de données : ' . DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        return 'Erreur : ' . $e->getMessage();
    }
});

// Route pour afficher toutes les questions (via le contrôleur)
Route::get('/questions', [QuestionController::class, 'index']);

// Route pour afficher le formulaire d'ajout d'une question (via le contrôleur)
Route::get('/questions/create', [QuestionController::class, 'create']);

// Route pour gérer la soumission du formulaire et ajouter une question dans la base de données
Route::post('/questions', [QuestionController::class, 'store']);

// Page pour tester une vue statique
Route::get('/about', function () {
    return view('about');
});
