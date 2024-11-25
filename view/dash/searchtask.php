<?php
include_once('../../controller/plancontroller.php');

$plancontroller = new plancontroller();

// Fetch all plans
$plans = $plancontroller->listPlans();

// Check if a plan is selected and fetch tasks for that plan
if (isset($_POST['search']) && isset($_POST['plan'])) {
    $planId = $_POST['plan'];
    // Fetch tasks by the selected plan ID
    $tasks = $plancontroller->listTaskByid($planId);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search tasks by plan</title>
</head>
<body align="center">

    <!-- Form to select a plan and search for tasks -->
    <form action="" method="POST">
        <label for="plan">choose a plan :</label>
        <select name="plan" id="plan">
            <?php
            // Loop through each plan and create options for the select dropdown
            foreach ($plans as $plan) {
                echo '<option value="' . $plan['id'] . '">' . $plan['nom'] . '</option>';
            }
            ?>
        </select>
        <input type="submit" value="search" name="search">
    </form>

    <!-- Display tasks related to the selected plan -->
    <?php if (isset($tasks)): ?>
        <link rel="stylesheet" href="styleplandash.css">
        <br> <br>

        <table class="custom-table">
            <thead>
                <tr>
                    <th>Task ID</th>
                    <th>Task Name</th>
                    <th>Task date</th>
                    <th>Task status</th>
                    <th>plan_id</th>                    
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($tasks)): ?>
                    <?php foreach ($tasks as $task): ?>
                        <tr>
                            <td><?= $task['id']; ?></td>
                            <td><?= $task['nom']; ?></td>
                            <td><?= $task['date']; ?></td>
                            <td><?= $task['etat']; ?></td>
                            <td><?= $task['plan_id']; ?></td>                            
                            <td>
                            <a href="deletetask.php?id=<?= $task['id']; ?>&plan_id=<?= $planId; ?>" class="btn-delete">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4"> No tasks available for this plan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    <?php endif; ?>

</body>
</html>
