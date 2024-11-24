<?php
include 'C:/xampp/htdocs/Crud Doudou/doudou/config.php';
include 'C:/xampp/htdocs/Crud Doudou/doudou/model/contact.php';
include 'C:/xampp/htdocs/Crud Doudou/doudou/controller/crudcontact.php';

try {
    $pdo = new PDO('mysql:host=localhost;dbname=contact', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'La connexion à la base de données a échoué: ' . $e->getMessage();
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $contact = new GContacte(null, $name, $email, $message);
    $gContacteC = new GContacteC($pdo);

    if ($gContacteC->supprimerContact($id)) {
        echo "<script>
                alert('Le message a été supprimé avec succès.');
                window.location.href = 'tablechatuser.php'; // Redirige vers la page des messages
              </script>";
    } else {
        echo "Erreur lors de la suppression du msg.";
    }
}

exit();

?>
