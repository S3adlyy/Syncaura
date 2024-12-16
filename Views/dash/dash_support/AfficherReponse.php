<?php
// Inclure votre contrôleur de réponse
include 'C:\xampp\htdocs\integration3\configg.php';
include 'C:\xampp\htdocs\integration3\models\Reponse.php';
include 'C:\xampp\htdocs\integration3\controller\reponseC.php';

// Connexion à la base de données
try {
    $pdo = new PDO('mysql:host=localhost;dbname=forum', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'La connexion à la base de données a échoué: ' . $e->getMessage();
    exit;
}

// Initialisation de la classe reponseC
$reponseC = new reponseC($pdo);

// Vérification si l'ID est passé via l'URL et s'il est valide
if (isset($_GET['id_question']) && is_numeric($_GET['id_question'])) {
    $idReponse = (int)$_GET['id_question'];
} else {
    echo '<p>ID de réponse invalide.</p>';
    exit; // Arrêter l'exécution si l'ID n'est pas valide
}

// Déboguer la valeur de $idReponse
var_dump($_GET); // Affiche le tableau $_GET pour vérifier si 'id_reponse' existe
var_dump($idReponse); // Affiche la valeur de $idReponse pour vérifier la récupération

if ($idReponse > 0) {
    // Récupérer les détails de la réponse
    $reponseDetails = $reponseC->showReponse($idReponse);

    // Déboguer la réponse retournée
    var_dump($reponseDetails); // Affiche les détails de la réponse pour vérifier si elle est bien récupérée

    if ($reponseDetails) {
        echo '
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Réponse</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .form-container {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .form-container label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: bold;
        }
        .form-container input, 
        .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            background: #f9f9f9;
        }
        .form-container textarea {
            resize: none;
            height: 80px;
        }
        .form-container input[readonly],
        .form-container textarea[readonly] {
            background-color: #e9ecef;
            color: #6c757d;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Détails de la Réponse</h2>
    <form>
        <label for="id_reponse">ID Réponse:</label>
        <input type="text" id="id_reponse" name="id_reponse" value="' . htmlspecialchars($reponseDetails['id_reponse']) . '" readonly>
        
        <label for="contenu_reponse">Contenu de la Réponse:</label>
        <textarea id="contenu_reponse" name="contenu_reponse" readonly>' . htmlspecialchars($reponseDetails['contenu_reponse']) . '</textarea>
        
        <label for="date_reponse">Date de la Réponse:</label>
        <input type="text" id="date_reponse" name="date_reponse" value="' . htmlspecialchars($reponseDetails['date_reponse']) . '" readonly>
        
        <label for="id_question">ID Question:</label>
        <input type="text" id="id_question" name="id_question" value="' . htmlspecialchars($reponseDetails['id_question']) . '" readonly>
    </form>
</div>
</body>
</html>';
    } else {
        echo '<p>Aucune réponse trouvée pour l\'ID spécifié.</p>';
    }
} else {
    echo '<p>ID de réponse invalide.</p>';
}
?>
