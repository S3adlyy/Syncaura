<?php
include 'C:/xampp/htdocs/Forum/controller/questionsC.php';

$questionList = new questionsC();
$questions = $questionList->listquestion(); // Assurez-vous que cette méthode retourne les données des questions sous forme d'un tableau associatif.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Liste des Questions</title>
      <!--<link rel="stylesheet" href="style1.css">-->
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <th>Questions</th>
                <th>Date de Création</th>
                <th>ID</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($questions)): ?>
                <?php foreach ($questions as $question): ?>
                    <tr>
                        <td><?= htmlspecialchars($question['questions']) ?></td>
                        <td><?= htmlspecialchars($question['date_creation']) ?></td>
                        <td><?= htmlspecialchars($question['id']) ?></td>
                        <td><?= htmlspecialchars($question['type']) ?></td>
                        <td>
                            <a href="updatequestion.php?id=<?= htmlspecialchars($question['id_question']) ?>">Update</a>
                            <a href="deletequestion.php?id=<?= htmlspecialchars($question['id_question']) ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Aucune question trouvée.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
