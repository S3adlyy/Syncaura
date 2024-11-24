<?php

include 'C:\xampp\htdocs\Crud Doudou\doudou\config.php'; // Contient la configuration PDO
include 'C:\xampp\htdocs\Crud Doudou\doudou\model\contact.php'; // Contient la classe GContacteC
include 'C:\xampp\htdocs\Crud Doudou\doudou\controller\crudcontact.php'; // Contient la logique de contrôle

try {
    $pdo = new PDO('mysql:host=localhost;dbname=contact', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'La connexion à la base de données a échoué: ' . $e->getMessage();
    exit;
}

// Vérifier si l'ID du contact est passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $gContacteC = new GContacteC($pdo);
    $contact = $gContacteC->afficherContactParId($id);  // Récupère les données du contact
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Créer un objet Contact avec les nouvelles informations
    $contact = new GContacte($nom, $email, $message);
    $contact->setId($id);  // Assigner l'ID pour la mise à jour

    // Mettre à jour le contact
    if ($contactC->modifierContact($contact)) {
        echo "Le contact a été mis à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour du contact.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Contact</title>
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
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            width: 100%;
        }

        .form-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
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
            background: #f9f9f9;
            font-size: 16px;
        }

        .form-container button {
            width: 100%;
            padding: 12px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Modifier le Contact</h2>
        <form method="POST">
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($contact['Nom']) ?>" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($contact['Email']) ?>" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" required><?= htmlspecialchars($contact['Message']) ?></textarea>

            <button type="submit">Modifier</button>
        </form>
    </div>
</body>
</html>
