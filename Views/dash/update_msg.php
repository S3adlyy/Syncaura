<?php
// Inclure les fichiers nécessaires (par exemple la classe de connexion et la classe GContacteC)
include 'C:\xampp\htdocs\Crud Doudou\doudou\config.php'; // Contient la configuration PDO
include 'C:\xampp\htdocs\Crud Doudou\doudou\model\contact.php'; // Contient la classe GContacteC
include 'C:\xampp\htdocs\Crud Doudou\doudou\controller\crudcontact.php'; // Contient le contrôleur

// Vérifier si l'ID du contact est passé dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Récupérer l'ID du contact
    $id = $_GET['id'];

    // Créer une instance de GContacteC pour récupérer le contact par ID
    $gContacteC = new GContacteC($pdo);

    // Récupérer les informations du contact par ID
    $contact = $gContacteC->afficherContactParId($id);

    // Vérifiez si le contact existe
    if ($contact) {
        // Utiliser l'opérateur de fusion null pour éviter les erreurs si certaines informations sont manquantes
        $name = $contact['name'] ?? '';
        $email = $contact['email'] ?? '';
        $message = $contact['message'] ?? '';
    } else {
        // Si aucun contact n'est trouvé, afficher un message d'erreur
        echo "Le contact avec l'ID $id n'existe pas.";
        exit;
    }
} else {
    // Si l'ID n'est pas défini, afficher un message d'erreur
    echo "ID du contact non défini.";
    exit;
}

// Traitement du formulaire de mise à jour (si soumis)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les valeurs du formulaire
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Vérifier si tous les champs sont remplis
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Mettre à jour les informations du contact
        $updateResult = $gContacteC->mettreAJourContact($id, $name, $email, $message);

        // Vérifier si la mise à jour a réussi
        if ($updateResult) {
            echo "<script>alert('Les informations du contact ont été mises à jour avec succès.'); window.location.href='contact.php';</script>";
        } else {
            echo "Une erreur est survenue lors de la mise à jour des informations.";
        }
    } else {
        echo "Tous les champs doivent être remplis.";
    }
}
?>