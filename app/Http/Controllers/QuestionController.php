<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

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

    // Met à jour une question existante (update)
    public function update(Request $request, $id)
    {
        // Trouver la question par ID
        $question = Question::find($id);

        // Vérifier si la question existe
        if (!$question) {
            return response()->json(['message' => 'Question non trouvée'], 404);
        }

        // Validation des données envoyées dans la requête (les champs sont optionnels)
        $validated = $request->validate([
            'title' => 'sometimes|string',
            'image_url' => 'nullable|string',
        ]);

        // Mettre à jour la question avec les données validées
        $question->update($validated);

        // Retourner la question mise à jour en réponse JSON
        return response()->json($question, 200);
    }

    // Supprime une question (destroy)
    public function destroy($id)
    {
        // Trouver la question par ID
        $question = Question::find($id);

        // Vérifier si la question existe
        if (!$question) {
            return response()->json(['message' => 'Question non trouvée'], 404);
        }

        // Supprimer la question
        $question->delete();

        // Retourner une réponse confirmant la suppression
        return response()->json(['message' => 'Question supprimée avec succès'], 200);
    }

    // (Optionnel) Si vous souhaitez toujours retourner les questions en JSON
    public function indexApi()
    {
        // Récupérer les questions avec leurs réponses
        return response()->json(Question::with('answers')->get(), 200);
    }
}
