<?php
include '../../controller/achatA.php';

$achatManager = new AchatManager();

// Check if the `id` parameter is set in the URL
if (isset($_GET["id"])) {
    // Call deleteAchat method
    $achatManager->deleteAchat($_GET["id"]);
}

// Redirect to the list view after deletion
header('Location: listAchat.php');
