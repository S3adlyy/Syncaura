<?php
include 'C:\xampp\htdocs\integration3\configg.php';
include 'C:\xampp\htdocs\integration3\models\Reponse.php';
include 'C:\xampp\htdocs\integration3\controller\reponseC.php';

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
    <title>Formulaire de Modification de Réponse</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #88caff, #4f80ff, #6240f5);
            background-size: 400% 400%;
            animation: gradientAnimation 15s ease infinite;
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

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

        .form-card h1 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-size: 16px;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group input[type="date"],
        .form-group textarea {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #007bff;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }

        .form-group button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-group button:hover {
            background-color: #0056b3;
        }
    </style>
    <script>
        function validateForm() {
            // Reset error messages
            let errorMessage = '';
            document.getElementById('error_message').innerHTML = '';

            // Get the values from the form
            const contenu = document.getElementById('contenu').value.trim();
            const date_reponse = document.getElementById('date_reponse').value.trim();
            const id_question = document.getElementById('id_question').value.trim();

            // Validate the 'contenu' field
            if (contenu === '') {
                errorMessage += 'Le contenu de la réponse est obligatoire.\n';
            }

            // Validate the 'date_reponse' field (Custom validation)
            const datePattern = /^\d{4}-\d{2}-\d{2}$/; // YYYY-MM-DD format
            if (date_reponse === '' || !datePattern.test(date_reponse)) {
                errorMessage += 'La date de la réponse doit être dans le format YYYY-MM-DD.\n';
            }

            // Validate the 'id_question' field
            if (id_question === '' || isNaN(id_question) || id_question <= 0) {
                errorMessage += 'L\'ID de la question doit être un nombre valide et supérieur à 0.\n';
            }

            // If there are any errors, display them
            if (errorMessage !== '') {
                document.getElementById('error_message').innerHTML = errorMessage.replace(/\n/g, '<br>');
                return false;  // Prevent form submission
            }

            return true;  // Allow form submission
        }
    </script>
</head>
<body>

    <div class="form-container">
        <div class="form-card">
            <h1>Modifier la réponse</h1>
            <div id="error_message" class="error-message"></div>

            <form method="POST" onsubmit="return validateForm()">
                <div class="form-group">
                    <label for="id_reponse">ID de la réponse :</label>
                    <input type="number" id="id_reponse" name="id_reponse" value="<?php echo htmlspecialchars($reponse['id_reponse']); ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="contenu">Contenu de la réponse :</label>
                    <textarea id="contenu" name="contenu" rows="4"><?php echo htmlspecialchars($reponse['contenu']); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="date_reponse">Date de la réponse :</label>
                    <input type="text" id="date_reponse" name="date_reponse" value="<?php echo htmlspecialchars($reponse['date_reponse']); ?>">
                </div>

                <div class="form-group">
                    <label for="id_question">ID de la question :</label>
                    <input type="number" id="id_question" name="id_question" value="<?php echo htmlspecialchars($reponse['id_question']); ?>">
                </div>

                <div class="form-group">
                    <button type="submit">Mettre à jour la réponse</button>
                    <input type="button" value="Retour à la liste" onclick="window.location.href='table_reponse.php'" style="background-color:red; color:white;">
                </div>
            </form>
        </div>
    </div>

</body>
</html>
