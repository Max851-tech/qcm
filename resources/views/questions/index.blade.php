<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Questions</title>
</head>
<body>
<h1>Liste des Questions</h1>
@if ($questions->isEmpty())
    <p>Aucune question trouvée.</p>
@else
    <ul>
        @foreach ($questions as $question)
            <li>
                <strong>{{ $question->title }}</strong>
                @if ($question->image_url)
                    <br><img src="{{ $question->image_url }}" alt="Image de la question" width="100">
                @endif

                <!-- Affichage des réponses associées à la question -->
                @if ($question->answers->isNotEmpty())
                    <ul>
                        @foreach ($question->answers as $answer)
                            <li>
                                {{ $answer->content }}
                                (Correct: {{ $answer->is_correct ? 'Oui' : 'Non' }})
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>Aucune réponse pour cette question.</p>
                @endif
            </li>
        @endforeach
    </ul>
@endif
</body>
</html>
