<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Exemple de route de test
Route::middleware('api')->get('/test', function () {
    return response()->json(['message' => 'API fonctionne !'], 200);
});


// routes/api.php
use App\Http\Controllers\QuestionController;

Route::get('/questions', [QuestionController::class, 'index']);
Route::post('/questions', [QuestionController::class, 'store']);
Route::get('/questions/{id}', [QuestionController::class, 'show']);
Route::put('/questions/{id}', [QuestionController::class, 'update']);
Route::delete('/questions/{id}', [QuestionController::class, 'destroy']);
