<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;

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

// Route pour soumettre une réponse à une question
Route::post('/questions/{questionId}/answers', [QuestionController::class, 'storeAnswer'])->name('answers.store');

// Routes pour les réponses
Route::get('/answers/{id}/edit', [AnswerController::class, 'edit'])->name('answers.edit');
Route::put('/answers/{id}', [AnswerController::class, 'update'])->name('answers.update');
Route::delete('/answers/{id}', [AnswerController::class, 'destroy'])->name('answers.destroy');

// Page pour tester une vue statique
Route::get('/about', function () {
    return view('about');
});

Route::get('/answers', [AnswerController::class, 'index'])->name('answers.index');

Route::post('/questions/{questionId}/answers', [QuestionController::class, 'storeAnswer'])->name('questions.storeAnswer');
