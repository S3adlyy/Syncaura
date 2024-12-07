<?php
// Inclure les fichiers nécessaires une seule fois
include 'C:\wamp64\www\crud kooli\config.php';
include 'C:\wamp64\www\crud kooli\model\Reponse.php';
include 'C:\wamp64\www\crud kooli\controller\reponseC.php';
include 'C:\wamp64\www\crud kooli\controller\questionsC.php';  // Inclure questionsC.php ici

// Instancier le contrôleur de réponses
$repC = new reponseC();

// Récupérer les réponses
$rep = $repC->listReponse();

// Instancier le contrôleur de questions
$questionsC = new questionsC();  // Vous pouvez maintenant instancier correctement questionsC

// Récupérer les questions
$questions = $questionsC->listquestion();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Pour les icônes -->
    <style>
        /* Style général de la page */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #4f80ff;
            margin: 0;
            padding: 0;
        }

        /* Conteneur des cartes */
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding: 30px;
        }

        /* Style de chaque carte */
        .card {
            width: 320px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
            padding: 25px;
            margin: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
            border: 1px solid #e1e4e8;
        }

        /* Effet de survol de la carte */
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        /* Entête de la carte */
        .card-header {
            font-size: 20px;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #f4f4f4;
            padding-bottom: 10px;
        }

        /* Corps de la carte */
        .card-body {
            color: #555;
            font-size: 16px;
            margin-bottom: 15px;
        }

        .card-body p {
            margin: 8px 0;
        }

        /* Pied de carte (pour les boutons) */
        .card-footer {
            text-align: center;
            margin-top: 15px;
        }

        /* Style des boutons */
        .button1 {
            background-color: transparent;
            border: 2px solid #007bff;
            border-radius: 8px;
            padding: 8px 16px;
            cursor: pointer;
            font-size: 16px;
            color: #007bff;
            transition: all 0.3s ease;
        }

        .button1:hover {
            background-color: #007bff;
            color: white;
            transform: scale(1.05);
        }

        .button1 i {
            margin-right: 8px;
            font-size: 18px;
        }

        /* Icônes dans les boutons */
        .button1.edit {
            border-color: #007bff;
            color: #007bff;
        }

        .button1.delete {
            border-color: #ff3b30;
            color: #ff3b30;
        }

        .button1.view {
            border-color: #28a745;
            color: #28a745;
        }

        /* Animation pour les icônes */
        .button1:hover i {
            transform: rotate(15deg);
        }
    </style>
</head>
<body>

<div class="card-container">
    <!-- Affichage des questions sous forme de cartes -->
    <?php
    foreach ($questions as $question) {
        echo '<div class="card">';
        echo '<div class="card-header">' . htmlspecialchars($question['questions']) . '</div>';
        echo '<div class="card-body">';
        echo '<p><strong>ID Question:</strong> ' . htmlspecialchars($question['id_question']) . '</p>';
        echo '<p><strong>Date de création:</strong> ' . htmlspecialchars($question['date_creation']) . '</p>';
        echo '<p><strong>Type:</strong> ' . htmlspecialchars($question['type']) . '</p>';
        echo '</div>';
        echo '<div class="card-footer">';
        echo '<button class="button1 edit" onclick="window.location.href = \'modifierQuestion.php?id=' . $question['id_question'] . '\';"><i class="fa fa-edit"></i> Modifier</button>';
        echo '<button class="button1 delete" onclick="window.location.href = \'suppressionQuestion.php?id=' . $question['id_question'] . '\';"><i class="fa fa-trash"></i> Supprimer</button>';
        echo '<button class="button1 view" onclick="window.location.href = \'AfficherQuestion.php?id=' . $question['id_question'] . '\';"><i class="fa fa-eye"></i> Voir</button>';
        echo '</div>';
        echo '</div>';
    }
    ?>
</div>

<div class="card-container">
    <!-- Affichage des réponses sous forme de cartes -->
    <?php
    foreach ($rep as $reponse) {
        echo '<div class="card">';
        echo '<div class="card-header">Réponse - ' . htmlspecialchars($reponse['id_reponse']) . '</div>';
        echo '<div class="card-body">';
        echo '<p><strong>Contenu de la réponse:</strong> ' . htmlspecialchars($reponse['contenu_reponse']) . '</p>';
        echo '<p><strong>Date de la réponse:</strong> ' . htmlspecialchars($reponse['date_reponse']) . '</p>';
        echo '<p><strong>Question concernée:</strong> ' . htmlspecialchars($reponse['contenu_question']) . '</p>';
        echo '</div>';
        echo '<div class="card-footer">';
        echo '<button class="button1 edit" onclick="window.location.href = \'modifierReponse.php?id=' . $reponse['id_reponse'] . '\';"><i class="fa fa-edit"></i> Modifier</button>';
        echo '<button class="button1 delete" onclick="window.location.href = \'suppressionReponse.php?id=' . $reponse['id_reponse'] . '\';"><i class="fa fa-trash"></i> Supprimer</button>';
        echo '<button class="button1 view" onclick="window.location.href = \'AfficherReponse.php?id=' . $reponse['id_reponse'] . '\';"><i class="fa fa-eye"></i> Voir</button>';
        echo '</div>';
        echo '</div>';
    }
    ?>
</div>

</body>
</html>
