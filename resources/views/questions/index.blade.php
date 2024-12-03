<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Questions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            color: #333;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        img {
            max-width: 200px;
            margin-top: 10px;
            display: block;
        }

        textarea {
            width: 100%;
            height: 60px;
            margin-top: 10px;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .delete-button {
            background-color: red;
            color: white;
            margin-top: 10px;
        }

        .responses {
            margin-top: 10px;
            padding-left: 20px;
        }

        .response-item {
            margin-bottom: 5px;
        }

        .success-message {
            color: green;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .error-message {
            color: red;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .edit-button {
            background-color: orange;
            color: white;
            margin-top: 10px;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
        }

        .edit-button:hover {
            background-color: #cc7a00;
        }
    </style>
</head>
<body>
<h1>Liste des Questions</h1>

<!-- Message de succès ou d'erreur -->
@if (session('success'))
    <div class="success-message">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="error-message">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if ($questions->isEmpty())
    <p>Aucune question trouvée.</p>
@else
    <ul>
        @foreach ($questions as $question)
            <li>
                <!-- Titre de la question -->
                <strong>{{ $question->title }}</strong>

                <!-- Image associée à la question (si disponible) -->
                @if ($question->image_url)
                    <img src="{{ $question->image_url }}" alt="Image de la question">
                @endif

                <!-- Bouton de modification de la question -->
                <a href="{{ url('/questions/'.$question->id.'/edit') }}" class="edit-button">Modifier la question</a>

                <!-- Liste des réponses -->
                <div class="responses">
                    <h4>Réponses :</h4>
                    @if ($question->answers->isEmpty())
                        <p>Aucune réponse pour cette question.</p>
                    @else
                        <ul>
                            @foreach ($question->answers as $answer)
                                <li class="response-item">
                                    {{ $answer->content }}
                                    @if ($answer->is_correct)
                                        <strong>(Correcte)</strong>
                                    @endif
                                    <!-- Bouton pour modifier une réponse -->
                                    <a href="{{ url('/answers/'.$answer->id.'/edit') }}" class="edit-button">Modifier la réponse</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <!-- Formulaire pour ajouter une réponse -->
                <form action="{{ url('/questions/'.$question->id.'/answers') }}" method="POST">
                    @csrf
                    <textarea name="content" placeholder="Votre réponse" required></textarea><br>
                    <label>
                        Réponse correcte ?
                        <input type="checkbox" name="is_correct" value="1">
                    </label><br>
                    <button type="submit">Ajouter une réponse</button>
                </form>

                <!-- Formulaire pour supprimer une question -->
                <form action="{{ url('/questions/'.$question->id) }}" method="POST" style="margin-top: 10px;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-button">Supprimer la question</button>
                </form>
            </li>
        @endforeach
    </ul>
@endif
</body>
</html>
