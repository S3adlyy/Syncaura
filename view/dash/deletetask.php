<?php
include('../../Controller/plancontroller.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Check if the user confirmed deletion
    if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
        $planController = new PlanController();
        $planController->deleteTask($id);
        header('Location: taskdash.php');
        exit();
    }

    // Display a confirmation message before deletion
    echo "<script>
        var result = confirm('Are you sure you want to delete this task?');
        if (result) {
            window.location.href = 'deletetask.php?id=$id&confirm=yes';
        } else {
            window.location.href = 'taskdash.php';
        }
    </script>";
} else {
    echo "No task selected for deletion.";
}
?>
