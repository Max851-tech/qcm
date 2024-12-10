<!-- resources/views/answers/index.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Réponses</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Liste des Réponses</h1>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Contenu</th>
            <th>Correcte</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($answers as $answer)
            <tr>
                <td>{{ $answer->id }}</td>
                <td>{{ $answer->content }}</td>
                <td>{{ $answer->is_correct ? 'Oui' : 'Non' }}</td>
                <td>
                    <a href="{{ route('answers.edit', $answer->id) }}" class="btn btn-primary">Modifier</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
