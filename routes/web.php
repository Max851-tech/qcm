<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;

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

// Routes pour les questions
Route::get('/questions', [QuestionController::class, 'index'])->name('questions.index');
Route::get('/questions/create', [QuestionController::class, 'create'])->name('questions.create');
Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');
Route::get('/questions/{id}/edit', [QuestionController::class, 'edit'])->name('questions.edit');
Route::put('/questions/{id}', [QuestionController::class, 'update'])->name('questions.update');
Route::delete('/questions/{id}', [QuestionController::class, 'destroy'])->name('questions.destroy');

// Routes pour les réponses
Route::post('/questions/{questionId}/answers', [QuestionController::class, 'storeAnswer'])->name('answers.store');
Route::get('/answers/{id}/edit', [AnswerController::class, 'edit'])->name('answers.edit');
Route::put('/answers/{id}', [AnswerController::class, 'update'])->name('answers.update');
Route::delete('/answers/{id}', [AnswerController::class, 'destroy'])->name('answers.destroy');
Route::post('/questions/{questionId}/submit-answer', [AnswerController::class, 'submitAnswer'])->name('answers.submit');
Route::get('/answers', [AnswerController::class, 'index'])->name('answers.index');

// Page pour tester une vue statique
Route::get('/about', function () {
    return view('about');
});

// Route pour le profil utilisateur
Route::get('/profile', [UserController::class, 'profile'])->name('profile')->middleware('auth');

// Route pour l'authentification et le tableau de bord
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Routes pour l'inscription
Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');

// Routes pour la connexion
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Route pour la déconnexion
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
