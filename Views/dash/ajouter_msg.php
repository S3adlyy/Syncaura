<?php
include 'C:/xampp/htdocs/Crud Doudou/doudou/config.php'; // Configuration de la base de données
include 'C:/xampp/htdocs/Crud Doudou/doudou/model/contact.php';
include 'C:/xampp/htdocs/Crud Doudou/doudou/controller/crudcontact.php'; // Inclusion de la classe GContacte

try {
    // Tentative de connexion à la base de données
    $pdo = new PDO('mysql:host=localhost;dbname=contact', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Si la connexion échoue, afficher un message d'erreur
    echo 'La connexion à la base de données a échoué: ' . $e->getMessage();
    exit;
}

// Vérifier si le formulaire a été soumis avec la méthode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire et les nettoyer
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';

    // Validation des données (tous les champs doivent être remplis)
    if (empty($name) || empty($email) || empty($message)) {
        echo "<script>alert('Tous les champs doivent être remplis.');</script>";
        exit;
    }

    // Validation de l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('L\'email fourni n\'est pas valide.');</script>";
        exit;
    }

    // Créer un objet GContacte avec les données du formulaire
    $contact = new GContacte(null, $name, $email, $message);

    // Créer une instance de GContacteC pour gérer les contacts
    $gContacteC = new GContacteC($pdo);

    // Appeler la méthode ajouterContact pour insérer le contact dans la base de données
    try {
        $result = $gContacteC->ajouterContact($contact);

        // Vérifier si l'ajout a réussi et rediriger ou afficher un message
        if ($result) {
            // Redirection après le succès de l'ajout
            header('Location: table_Chatuser.php');
            exit; // Assurez-vous que le script s'arrête après la redirection
        } else {
            echo "<script>alert('Une erreur est survenue. Veuillez réessayer.');</script>";
        }
    } catch (Exception $e) {
        // Afficher l'erreur si l'insertion échoue
        echo "<script>alert('Erreur: " . $e->getMessage() . "');</script>";
    }
}
?>
