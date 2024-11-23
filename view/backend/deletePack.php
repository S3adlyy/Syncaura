<?php
include 'C:\xampp1\htdocs\projetrayen\controller\packP.php';
$PackController = new PackController();

if (isset($_GET["id"])) {
    $PackController->deletePack($_GET["id"]); 
    header('Location: listPack.php');  
    exit();  
}
?>
