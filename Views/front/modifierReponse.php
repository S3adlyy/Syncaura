<?php
include 'C:\wamp64\www\crud kooli\config.php';
include 'C:\wamp64\www\crud kooli\model\Reponse.php';
include 'C:\wamp64\www\crud kooli\controller\reponseC.php';

// Créer une instance du contrôleur
$repC = new reponseC();

// Vérifier si l'ID de la réponse est passé via l'URL
if (isset($_GET['id'])) {
    $id_reponse = $_GET['id'];

    // Récupérer les données de la réponse dans la base de données
    $sql = "SELECT * FROM reponse WHERE id_reponse = :id_reponse";
    $db = config::getConnexion();
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id_reponse', $id_reponse);
    $stmt->execute();
    $reponse = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Si le formulaire est soumis pour mettre à jour la réponse
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $contenu = $_POST['contenu'];
    $date_reponse = $_POST['date_reponse'];
    $id_question = $_POST['id_question'];

    // Créer un objet réponse avec les nouvelles données
    $reponseObj = new Reponse(
        $reponse['id_reponse'],   // L'ID existant de la réponse
        $contenu,                  // Nouveau contenu de la réponse
        new DateTime($date_reponse),  // Date de la réponse (en tant qu'objet DateTime)
        $id_question               // ID de la question associée
    );

    // Appeler la méthode pour mettre à jour la réponse dans la base de données
    $repC->updateReponse($reponseObj, $id_reponse);

    // Rediriger vers la page de la liste des réponses après la mise à jour
    header("Location: table_reponse.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la Réponse</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* General body styling */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #4f80ff, #6240f5, #88caff);
            background-size: 400% 400%;
            animation: gradientAnimation 15s ease infinite;
        }

        /* Background gradient animation */
        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Form container */
        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        /* Form card */
        .form-card {
            width: 500px;
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
            padding: 30px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(225, 228, 232, 0.7);
        }

        .form-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        /* Form title */
        .form-card h1 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Form elements */
        .form-card label {
            display: block;
            font-size: 16px;
            color: #555;
            margin-bottom: 5px;
        }

        .form-card input[type="text"],
        .form-card input[type="number"],
        .form-card input[type="date"],
        .form-card textarea {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-bottom: 20px;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .form-card input:focus,
        .form-card textarea:focus {
            border-color: #007bff;
        }

        /* Button styling */
        .form-card input[type="submit"],
        .form-card input[type="button"] {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            width: 100%;
        }

        .form-card input[type="button"] {
            background-color: red;
        }

        .form-card input[type="submit"]:hover,
        .form-card input[type="button"]:hover {
            transform: scale(1.05);
        }

        /* Responsive design */
        @media (max-width: 600px) {
            .form-card {
                width: 90%;
            }
        }
    </style>
</head>
<body>

<div class="form-container">
    <div class="form-card">
        <h1>Modifier la Réponse</h1>
        <form method="POST" action="">
            <label for="id_reponse">ID de la réponse :</label>
            <input type="number" id="id_reponse" name="id_reponse" value="<?php echo htmlspecialchars($reponse['id_reponse']); ?>" readonly>

            <label for="contenu">Contenu de la réponse :</label>
            <textarea id="contenu" name="contenu" rows="4" required><?php echo htmlspecialchars($reponse['contenu']); ?></textarea>

            <label for="date_reponse">Date de la réponse :</label>
            <input type="date" id="date_reponse" name="date_reponse" value="<?php echo htmlspecialchars($reponse['date_reponse']); ?>" required>

            <label for="id_question">ID de la question :</label>
            <input type="number" id="id_question" name="id_question" value="<?php echo htmlspecialchars($reponse['id_question']); ?>" required>

            <input type="submit" value="Mettre à jour la réponse">
            <input type="button" value="Retour à la liste" onclick="window.location.href='table_reponse.php'">
        </form>
    </div>
</div>

</body>
</html>
