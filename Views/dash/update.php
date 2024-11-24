<?php
// Inclure les fichiers nécessaires
include 'C:\xampp\htdocs\Crud Doudou\doudou\config.php';
include 'C:\xampp\htdocs\Crud Doudou\doudou\model\contact.php';
include 'C:\xampp\htdocs\Crud Doudou\doudou\controller\crudcontact.php';

// Connexion à la base de données
try {
    $pdo = new PDO('mysql:host=localhost;dbname=contact', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'La connexion à la base de données a échoué: ' . $e->getMessage();
    exit;
}

// Vérifier si le formulaire a été soumis pour modifier un contact
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $contactId = isset($_POST['contact_id']) ? $_POST['contact_id'] : null;
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';

    // Validation des données (tous les champs doivent être remplis)
    if (empty($contactId) || empty($name) || empty($email) || empty($message)) {
        echo "<script>alert('Tous les champs doivent être remplis.');</script>";
        exit;
    }

    // Créer un objet GContacte avec les données du formulaire
    $contact = new GContacte($contactId, $name, $email, $message);

    // Créer une instance de GContacteC pour gérer les contacts
    $gContacteC = new GContacteC($pdo);

    // Appeler la méthode modifierContact pour mettre à jour le contact
    try {
        $result = $gContacteC->modifierContact($contact, $contactId);

        // Vérifier si la mise à jour a réussi
        if ($result) {
            echo "<script>alert('Votre message a été mis à jour avec succès !'); window.location.href='table_Chatuser.php';</script>";
        } else {
            echo "<script>alert('Une erreur est survenue lors de la mise à jour.');</script>";
        }
    } catch (Exception $e) {
        // Afficher l'erreur si la mise à jour échoue
        echo "<script>alert('Erreur: " . $e->getMessage() . "');</script>";
    }
}
?>
