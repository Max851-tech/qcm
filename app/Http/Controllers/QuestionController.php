<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;  // Assurez-vous que vous avez le modèle Answer

class QuestionController extends Controller
{
    // Liste toutes les questions pour afficher dans la vue (HTML)
    public function index()
    {
        // Récupérer les questions avec leurs réponses
        $questions = Question::with('answers')->get();

        // Retourner la vue avec les données
        return view('questions.index', compact('questions'));
    }

    // Affiche une question spécifique (show)
    public function show($id)
    {
        // Trouver la question par ID
        $question = Question::find($id);

        // Vérifier si la question existe
        if (!$question) {
            return response()->json(['message' => 'Question non trouvée'], 404);
        }

        // Retourner la question en JSON
        return response()->json($question, 200);
    }

    // Affiche le formulaire pour créer une nouvelle question (create)
    public function create()
    {
        // Retourner la vue de création de question
        return view('questions.create');
    }

    // Crée une nouvelle question (store)
    public function store(Request $request)
    {
        // Validation des données envoyées dans la requête
        $validated = $request->validate([
            'title' => 'required|string',
            'image_url' => 'nullable|string',
        ]);

        // Créer une nouvelle question avec les données validées
        $question = Question::create($validated);

        // Rediriger vers la page des questions avec un message de succès
        return redirect('/questions')->with('success', 'Question ajoutée avec succès !');
    }

    // Affiche le formulaire d'édition pour une question existante
    public function edit($id)
    {
        // Trouver la question par ID
        $question = Question::find($id);

        // Vérifier si la question existe
        if (!$question) {
            // Si la question n'est pas trouvée, rediriger avec un message d'erreur
            return redirect()->route('questions.index')->with('error', 'Question non trouvée.');
        }

        // Retourner la vue d'édition avec la question
        return view('questions.edit', compact('question'));
    }

    // Met à jour une question existante (update)
    public function update(Request $request, $id)
    {
        // Validation des données envoyées dans la requête
        $validated = $request->validate([
            'title' => 'required|string',
            'image_url' => 'nullable|string',
        ]);

        // Trouver la question par ID
        $question = Question::find($id);

        // Vérifier si la question existe
        if (!$question) {
            return redirect('/questions')->with('error', 'Question non trouvée.');
        }

        // Mettre à jour la question avec les données validées
        $question->update($validated);

        // Rediriger avec un message de succès
        return redirect('/questions')->with('success', 'Question mise à jour avec succès !');
    }

    // Supprime une question (destroy)
    public function destroy($id)
    {
        // Trouver la question par ID
        $question = Question::find($id);

        // Vérifier si la question existe
        if (!$question) {
            return redirect('/questions')->with('error', 'Question non trouvée.');
        }

        // Supprimer la question
        $question->delete();

        // Rediriger avec un message de succès
        return redirect('/questions')->with('success', 'Question supprimée avec succès !');
    }

    // Retourne toutes les questions en JSON (API)
    public function indexApi()
    {
        // Récupérer les questions avec leurs réponses
        return response()->json(Question::with('answers')->get(), 200);
    }

    // Méthode pour ajouter une réponse à une question
    public function storeAnswer(Request $request, $questionId)
    {
        // Validation des données envoyées dans la requête
        $request->validate([
            'content' => 'required|string|max:255',
            'is_correct' => 'nullable|boolean',
        ]);

        // Trouver la question associée
        $question = Question::findOrFail($questionId);

        // Créer une nouvelle réponse
        $answer = new Answer();
        $answer->content = $request->input('content');
        $answer->is_correct = $request->has('is_correct');
        $answer->question_id = $question->id;
        $answer->save();

        // Rediriger vers la page de la question avec un message de succès
        return redirect()->route('questions.edit', $question->id)
            ->with('success', 'Réponse ajoutée avec succès');
    }
}
