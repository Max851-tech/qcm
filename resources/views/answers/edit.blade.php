<!-- resources/views/answers/edit.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la réponse</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Modifier la réponse</h1>

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

    <!-- Formulaire de modification de la réponse -->
    <form action="{{ route('answers.update', $answer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Champ pour modifier le contenu de la réponse -->
        <div class="form-group">
            <label for="content">Contenu de la réponse</label>
            <input type="text" name="content" id="content" class="form-control" value="{{ old('content', $answer->content) }}" required>
        </div>

        <!-- Champ pour marquer la réponse comme correcte -->
        <div class="form-group mt-3">
            <label for="is_correct">Est-ce la réponse correcte ?</label>
            <input type="checkbox" name="is_correct" id="is_correct" {{ old('is_correct', $answer->is_correct) ? 'checked' : '' }}>
        </div>

        <!-- Boutons pour soumettre ou annuler -->
        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('answers.index') }}" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>
</body>
</html>
