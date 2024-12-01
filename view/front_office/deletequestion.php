<?php
include 'C:/xampp/htdocs/Forum/controller/questionsC.php';
include 'C:/xampp/htdocs/Forum/config.php';

if (isset($_GET['id'])) { 
    $questionId = $_GET['id'];
    $questionC = new questionsC();
    $questionC->deletequestion($questionId);

    header('Location: liste.php');
    exit;
} else {
    echo "ID de la question non fourni.";
}
?>
