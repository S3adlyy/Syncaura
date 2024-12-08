<?php
include_once "../../../controller/plancontroller.php";

if (isset($_GET['nom'])) { 
    $planName = $_GET['nom']; // Get the plan name from the query parameter

    // Check if the user confirmed deletion
    if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
        $planController = new PlanController();
        $planController->deletePlan($planName); // Call deletePlan with the plan name
        header('Location: todolist.php'); // Redirect to the plans page
        exit();
    }

    // Display a confirmation message before deletion
    echo "<script>
        if (confirm('Are you sure you want to delete the plan \"$planName\"?')) {
            window.location.href = 'deleteplan.php?nom=" . urlencode($planName) . "&confirm=yes';
        } else {
            window.location.href = 'todolist.php';
        }
    </script>";
} else {
    echo "No plan selected for deletion.";
}
?>
