<?php
include_once('../../Controller/PlanController.php');

$planController = new PlanController();

// Fetch all plans
$plans = $planController->listPlans();

// Check if a plan is selected and fetch tasks for that plan
if (isset($_POST['search']) && isset($_POST['plan'])) {
    $planName = $_POST['plan'];
    $tasks = $planController->listTaskByPlanName($planName);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Tasks by Plan</title>
    <link rel="stylesheet" href="styleplandash.css">
</head>
<body align="center">
    <!-- Form to select a plan and search for tasks -->
    <form action="searchtaskdash.php" method="POST">
        <label for="plan">Choose a plan:</label>
        <select name="plan" id="plan">
            <?php foreach ($plans as $plan): ?>
                <option value="<?= $plan['nom']; ?>"><?= $plan['nom']; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Search" name="search">
    </form>

    <!-- Display tasks related to the selected plan -->
    <?php if (isset($tasks)): ?>
        <br><br>
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
                            <td><?= $task['nom']; ?></td>
                            <td><?= $task['date']; ?></td>
                            <td><?= $task['etat']; ?></td>
                            <td><?= $task['plan_name']; ?></td>
                            <td>
                                <a href="deletetask.php?id=<?= $task['id']; ?>&plan_name=<?= $task['plan_name']; ?>" class="btn-delete">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No tasks available for this plan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
