<?php
include('../../Controller/PlanController.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Check if the user confirmed deletion
    if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
        $planController = new PlanController();
        $planController->deletePlan($id);
        header('Location: listeplan.php');
        exit();
    }

    // Display a confirmation message before deletion
    echo "<script>
        var result = confirm('Are you sure you want to delete this plan?');
        if (result) {
            window.location.href = 'deleteplan.php?id=$id&confirm=yes';
        } else {
            window.location.href = 'listeplan.php';
        }
    </script>";
} else {
    echo "No plan selected for deletion.";
}
?>
