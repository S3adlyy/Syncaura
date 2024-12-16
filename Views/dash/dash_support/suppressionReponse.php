<?php
include 'C:\xampp\htdocs\integration3\configg.php';
include 'C:\xampp\htdocs\integration3\controller\questionsC.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $reponseC = new reponseC();

    if ($reponseC->deleteReponse($id)) {
        header('Location: table_reponse.php?message=reponse deleted successfully');
        exit;
    } else {
        echo "Error: Unable to delete reponse.";
    }
} else {
    echo "Invalid ID.";
}
?>