<?php
include_once "../../../controller/plancontroller.php";
$planController = new PlanController();

// Fetch all plans
$plans = $planController->listPlansALL();

// Initialize variables
$tasks = [];
$totalTasksByPlanName = 0;

// Check if a plan is selected and fetch tasks for that plan
if (isset($_POST['search']) && isset($_POST['plan'])) {
    $planName = $_POST['plan'];
    $tasks = $planController->listTaskByPlanName($planName);
    $totalTasksByPlanName = $planController->getTotalTasksByPlanName($planName);

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Tasks by Plan</title>
    <link rel="stylesheet" href="styleplandash.css">
    <style>
        body {
            background-color: #f4f7fc;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #355ccc;
            font-weight: bold; /* Made the title bold */
        }

        form {
            margin-bottom: 20px;
            text-align: center;
        }

        select {
            padding: 8px;
            border-radius: 5px;
            font-size: 14px;
            width: 200px;
            margin-right: 10px;
        }

        input[type="submit"] {
            background-color: #355CCC;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #2e4cb0;
        }

        table.custom-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table.custom-table th, table.custom-table td {
            padding: 12px 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table.custom-table th {
            background-color: #355ccc;
            color: white;
        }

        table.custom-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table.custom-table tr:hover {
            background-color: #f1f1f1;
        }

        .btn-delete {
            background-color: #e74c3c;
            color: white;
            padding: 6px 12px;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-delete:hover {
            background-color: #c0392b;
        }

        .no-tasks {
            text-align: center;
            font-style: italic;
            color: #888;
            padding: 20px;
        }
    </style>
</head>
<body>

<div >
    <!-- Form to select a plan and search for tasks -->
    <form action="searchtaskdash.php" method="POST">
        <label for="plan">Choose a plan:</label>
        <select name="plan" id="plan">
            <?php foreach ($plans as $plan): ?>
                <option value="<?= $plan['nom']; ?>" 
                    <?php if (isset($planName) && $planName == $plan['nom']) echo 'selected'; ?> >
                    <?= $plan['nom']; ?>
                </option>            
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Search" name="search">
    </form>

    <!-- Display tasks related to the selected plan -->
    <?php if (isset($_POST['search']) && isset($planName)): ?>
    <br>
    <p>
        Total Tasks for 
        <strong>
            <?= htmlspecialchars($planName); ?>
        </strong>: <?= isset($totalTasksByPlanName) ? $totalTasksByPlanName : 0; ?>
    </p>
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
                                <a href="deletetask.php?id=<?= $task['id']; ?>&plan_name=<?= $task['plan_name']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this task?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="no-tasks">No tasks available for this plan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

</body>
</html>
