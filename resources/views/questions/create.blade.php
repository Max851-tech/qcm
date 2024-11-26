<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Question</title>
</head>
<body>
<h1>Ajouter une Question</h1>

<form action="{{ url('/questions') }}" method="POST">
    @csrf
    <label for="title">Titre :</label><br>
    <input type="text" id="title" name="title" required><br><br>

    <label for="image_url">URL de l'image (optionnel) :</label><br>
    <input type="text" id="image_url" name="image_url"><br><br>

    <button type="submit">Ajouter la question</button>
</form>

</body>
</html>
