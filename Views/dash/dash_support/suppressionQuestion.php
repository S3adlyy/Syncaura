<?php
include 'C:\xampp\htdocs\integration3\configg.php';
include 'C:\xampp\htdocs\integration3\controller\questionsC.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $questionsC = new questionsC();

    if ($questionsC->deleteQuestion($id)) {
        header('Location: ../front/supportClient.php');
        exit;
    } else {
        echo "Error: Unable to delete question.";
    }
} else {
    echo "Invalid ID.";
}
?>
