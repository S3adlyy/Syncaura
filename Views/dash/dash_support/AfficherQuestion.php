<?php
include 'C:\xampp\htdocs\integration3\configg.php';
include 'C:\xampp\htdocs\integration3\models\questions.php';
include 'C:\xampp\htdocs\integration3\controller\questionsC.php';

// Créer une instance de la classe questionsC
$questionsC = new questionsC();

// Vérifier si l'ID de la question est passé dans l'URL
if (isset($_GET['id'])) {
    $id_question = $_GET['id']; // Récupérer l'ID de la question à afficher

    // Appeler la fonction showQuestion pour récupérer la question spécifique
    $question = $questionsC->showQuestion($id_question);

    // Si la question n'est pas trouvée
    if (!$question) {
        die("Question not found");
    }
} else {
    die("No question ID provided");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afficher Question</title>
</head>
<body>

<h2>Détails de la Question</h2>

<form>
    <label for="id_question">ID de la Question:</label><br>
    <input type="text" id="id_question" name="id_question" value="<?php echo htmlspecialchars($question['id_question']); ?>" readonly><br><br>

    <label for="questions">Question:</label><br>
    <input type="text" id="questions" name="questions" value="<?php echo htmlspecialchars($question['questions']); ?>" readonly><br><br>

    <label for="date_creation">Date de Création:</label><br>
    <input type="text" id="date_creation" name="date_creation" value="<?php echo htmlspecialchars($question['date_creation']); ?>" readonly><br><br>

    <label for="id">ID:</label><br>
    <input type="text" id="id" name="id" value="<?php echo htmlspecialchars($question['id']); ?>" readonly><br><br>

    <label for="type">Type:</label><br>
    <input type="text" id="type" name="type" value="<?php echo htmlspecialchars($question['type']); ?>" readonly><br><br>

    <!-- Vous pouvez ajouter un bouton pour revenir à la liste des questions -->
    <a href="table_questions.php">Retour à la liste des questions</a>
</form>

</body>
</html>
