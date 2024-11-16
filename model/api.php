<?php
require_once 'pack_manager.php';
$manager = new PackManager();

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    // Ajouter un nouveau pack
    if ($action === 'add_pack' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = htmlspecialchars($_POST['nom'], ENT_QUOTES, 'UTF-8');
        $description = htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');
        $prix = $_POST['prix'];
        $image = $_FILES['image'];

        if ($image['error'] === 0) {
            $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($image['type'], $allowedMimeTypes) && $image['size'] <= 5000000) {
                $uploadDir = 'uploads/';
                $imagePath = $uploadDir . basename($image['name']);
                if (move_uploaded_file($image['tmp_name'], $imagePath)) {
                    $success = $manager->addPack($nom, $description, $prix, $imagePath);
                    $message = $success ? "Pack ajoutee avec succes !" : "Erreur lors de l'ajout du pack.";
                } else {
                    $message = "Erreur lors de l'enregistrement de l'image.";
                }
            } else {
                $message = "Fichier image invalide ou trop volumineux.";
            }
        } else {
            $message = "Erreur avec le fichier image.";
        }

        header("Location: admin.php?message=" . urlencode($message));
        exit();
    }

    // Modifier un pack existant
    elseif ($action === 'update_pack' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $nom = $_POST['nom'] ?? null;
        $description = $_POST['description'] ?? null;
        $prix = $_POST['prix'] ?? null;
        $image = $_FILES['image'] ?? null;

        $imagePath = null;
        if ($image && $image['error'] === 0) {
            $uploadDir = 'uploads/';
            $imagePath = $uploadDir . basename($image['name']);
            if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
                $message = "Erreur lors de l'enregistrement de l'image.";
                header("Location: admin.php?message=" . urlencode($message));
                exit();
            }
        }

        $success = $manager->updatePack($id, $nom, $description, $prix, $imagePath);
        $message = $success ? "Pack mis a jour avec succes !" : "Erreur lors de la mise à jour du pack.";
        header("Location: admin.php?message=" . urlencode($message));
        exit();
    }

    // Supprimer un pack
    elseif ($action === 'delete_pack' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $success = $manager->deletePack($id);
        $message = $success ? "Pack supprimee avec succès !" : "Erreur lors de la suppression du pack.";
        header("Location: admin.php?message=" . urlencode($message));
        exit();
    }

} else {
    // Redirection si aucune action n'est spécifiée
    header("Location: admin.php?message=" . urlencode("Action non spécifiée."));
    exit();
}
?>


