<?php
include_once "../../../controller/plancontroller.php";

if (isset($_GET['id']) && isset($_GET['plan_name'])) {
    $id = $_GET['id'];
    $planName = $_GET['plan_name'];

    // Check if the user confirmed deletion
    if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
        $planController = new PlanController();
        $planController->deleteTask($id, $planName);
        header('Location: taskdash.php');
        exit();
    }

    // Display a confirmation message before deletion
    echo "<script>
        var result = confirm('Are you sure you want to delete this task?');
        if (result) {
            window.location.href = 'deletetask.php?id=$id&plan_name=$planName&confirm=yes';
        } else {
            window.location.href = 'taskdash.php';
        }
    </script>";
} else {
    echo "No task selected for deletion.";
}
?>
