<?php
include('../../Controller/PlanController.php');
$planController = new PlanController();
$tasks = $planController->listTasks();
?>

<!-- Link to external CSS file -->
<link rel="stylesheet" href="styleplandash.css">
 <br>
<!-- Updated table with custom styles -->
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
        <?php foreach ($tasks as $task): ?>
            <tr>
                <td><?= $task['id']; ?></td>
                <td><?= $task['nom']; ?></td>
                <td><?= $task['date']; ?></td>
                <td><?= $task['etat']; ?></td>
                <td><?= $task['plan_id']; ?></td>
                <td>
                    <a href="deletetask.php?id=<?= $task['id']; ?>" class="btn-delete">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
