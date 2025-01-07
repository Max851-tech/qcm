<!-- resources/views/profile.blade.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil de {{ $user->name }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Profil de {{ $user->name }}</h1>

    <!-- Affichage du score -->
    <h3>Score Total : {{ $totalScore }}</h3>

    <div class="mt-3">
        <h4>Email : {{ $user->email }}</h4>
        <!-- Autres informations utilisateur ici -->
    </div>

    <!-- Si tu veux ajouter un bouton pour retourner à la page d'accueil -->
    <a href="{{ route('questions.index') }}" class="btn btn-primary mt-3">Retour aux questions</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
