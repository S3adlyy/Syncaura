<?php
include '../../controller/achatA.php';

$achatManager = new AchatManager();

if (isset($_GET["id"])) {
    $achatManager->deleteAchat($_GET["id"]);
}

header('Location: listAchat.php');
