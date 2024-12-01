<?php
include 'C:/xampp/htdocs/Forum/controller/reponseC.php';
include 'C:/xampp/htdocs/Forum/config.php';

// Initialiser le contrôleur
$reponseC = new reponseC();

// Gérer le formulaire après soumission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Création de l'objet réponse
    $reponse = new reponse(
        null, // ID auto-incrémenté
        $_POST['contenu'], // Contenu de la réponse
        new DateTime($_POST['date_reponse']), // Date de la réponse
        $_POST['id_reponse'] // ID de la reponse
    );

    // Ajouter la réponse
    $reponseC->addReponse($reponse);

    // Message de confirmation
    echo "<p>Réponse ajoutée avec succès !</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add reponse</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="controle1.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Add reponse</h1>

    <!-- Formulaire pour Add reponse -->
    <form method="POST" action="">
        <div class="mb-3">
            <label for="contenu" class="form-label">Contenu de la réponse :</label>
            <textarea class="form-control" id="contenu" name="contenu" rows="4"></textarea>
        </div>
        <div class="mb-3">
            <label for="date_reponse" class="form-label">Date de réponse :</label>
            <input type="datetime-local" class="form-control" id="date_reponse" name="date_reponse">
        </div>
        <div class="mb-3">
            <label for="id_reponse" class="form-label">ID de la reponse :</label>
            <input type="number" class="form-control" id="id_reponse" name="id_reponse" value="1">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
