<?php
include('../../Controller/PlanController.php');

// Instantiate the controller
$planController = new PlanController();

// Fetch all tasks
$tasks = $planController->listTasks();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
    <link rel="stylesheet" href="styleplandash.css">
</head>
<body align="center">
    <br>

    <!-- Task Table -->
    <table class="custom-table">
        <thead>
            <tr>
                <th>Task Name</th>
                <th>Task Date</th>
                <th>Task Status</th>
                <th>Plan Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($tasks)): ?>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= htmlspecialchars($task['nom']); ?></td>
                        <td><?= htmlspecialchars($task['date']); ?></td>
                        <td><?= htmlspecialchars($task['etat']); ?></td>
                        <td><?= htmlspecialchars($task['plan_name']); ?></td>
                        <td>
                            <a href="deletetask.php?id=<?= urlencode($task['id']); ?>&plan_name=<?= urlencode($task['plan_name']); ?>" class="btn-delete">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No tasks available.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
