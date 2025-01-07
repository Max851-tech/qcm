<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    // Afficher le formulaire d'édition d'une réponse
    public function edit($id)
    {
        // Trouver la réponse par ID
        $answer = Answer::find($id);

        // Vérifier si la réponse existe
        if (!$answer) {
            return redirect()->route('answers.index')->with('error', 'Réponse non trouvée.');
        }

        // Retourner la vue d'édition
        return view('answers.edit', compact('answer'));
    }

    // Mettre à jour une réponse
    public function update(Request $request, $id)
    {
        // Convertir la case à cocher 'is_correct' en booléen
        $request->merge([
            'is_correct' => $request->has('is_correct'),
        ]);

        // Validation de la réponse
        $validated = $request->validate([
            'content' => 'required|string',
            'is_correct' => 'required|boolean', // S'assure que 'is_correct' est un booléen
        ]);

        // Trouver la réponse à mettre à jour
        $answer = Answer::findOrFail($id);

        // Mise à jour des données
        $answer->update([
            'content' => $validated['content'],
            'is_correct' => $validated['is_correct'], // Enregistre 'true' ou 'false'
        ]);

        // Redirection avec un message de succès
        return redirect()->route('questions.index')->with('success', 'Réponse mise à jour avec succès');
    }

    // Afficher toutes les réponses
    public function index()
    {
        // Récupère toutes les réponses
        $answers = Answer::all();

        // Retourne une vue avec les réponses
        return view('answers.index', compact('answers'));
    }

    // Supprimer une réponse
    public function destroy($id)
    {
        // Trouver et supprimer la réponse
        $answer = Answer::findOrFail($id);
        $answer->delete();

        // Redirection avec un message de succès
        return redirect()->route('questions.index')->with('success', 'Réponse supprimée avec succès');
    }

    // Soumettre une réponse
    public function submitAnswer(Request $request, $questionId)
    {
        $validated = $request->validate([
            'answer_id' => 'required|exists:answers,id', // Vérifie que la réponse existe
        ]);

        $answer = Answer::findOrFail($validated['answer_id']);
        $user = auth()->user(); // Utilisateur connecté (ajuste si non utilisé)

        // Vérifie si la réponse est correcte
        $isCorrect = $answer->is_correct;

        // Calcul du score (par exemple, +10 pour une bonne réponse)
        $score = $isCorrect ? 10 : 0;

        // Enregistre l'attente de la réponse
        $user->attempts()->create([
            'question_id' => $questionId,
            'is_correct' => $isCorrect,
            'score' => $score,
        ]);

        // Mets à jour le score total de l'utilisateur
        $user->score += $score;
        $user->save();

        // Redirige avec un message
        return redirect()->route('questions.index')->with(
            'success',
            $isCorrect ? 'Bonne réponse ! +10 points.' : 'Mauvaise réponse. Aucun point gagné.'
        );
    }
}
