<?php
include 'C:\xampp\htdocs\integration3\controller\packP.php';
$PackController = new PackController();

if (isset($_GET["id"])) {
    $PackController->deletePack($_GET["id"]); 
    header('Location: listPack.php');  
    exit();  
}
?>
