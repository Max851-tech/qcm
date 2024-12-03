<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la question et ses réponses</title>
    <!-- Ici, vous pouvez lier vos fichiers CSS comme Bootstrap ou votre propre fichier CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1>Modifier la question et ses réponses</h1>

    <!-- Affichage des erreurs -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('questions.update', $question->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Section pour modifier la question -->
        <div class="form-group">
            <label for="title">Titre de la question</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $question->title) }}" required>
        </div>

        <div class="form-group mt-3">
            <label for="image_url">URL de l'image</label>
            <input type="text" name="image_url" id="image_url" class="form-control" value="{{ old('image_url', $question->image_url) }}">
        </div>

        <hr>

        <!-- Section pour afficher et modifier les réponses -->
        <h3>Réponses</h3>
        @foreach ($question->answers as $answer)
            <div class="form-group">
                <label for="answer_{{ $answer->id }}">Réponse {{ $loop->iteration }}</label>
                <input type="text" name="answers[{{ $answer->id }}]" id="answer_{{ $answer->id }}" class="form-control" value="{{ old('answers.' . $answer->id, $answer->content) }}">
                <label for="is_correct_{{ $answer->id }}" class="mt-2">
                    <input type="checkbox" name="is_correct[{{ $answer->id }}]" id="is_correct_{{ $answer->id }}" {{ $answer->is_correct ? 'checked' : '' }}>
                    Est-ce la réponse correcte ?
                </label>
            </div>
        @endforeach

        <div class="form-group">
            <label for="new_answer">Ajouter une nouvelle réponse</label>
            <input type="text" name="new_answer" id="new_answer" class="form-control" placeholder="Nouvelle réponse">
        </div>

        <hr>

        <!-- Boutons d'action -->
        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('questions.index') }}" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>

<!-- Optionnel : Vous pouvez ajouter des scripts JS si nécessaire -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
