<?php
include 'C:\wamp64\www\crud kooli\config.php';
include 'C:\wamp64\www\crud kooli\controller\questionsC.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $questionsC = new questionsC();

    if ($questionsC->deleteQuestion($id)) {
        header('Location: table_questions.php?message=Question deleted successfully');
        exit;
    } else {
        echo "Error: Unable to delete question.";
    }
} else {
    echo "Invalid ID.";
}
?>
