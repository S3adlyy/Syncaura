<?php

session_start();
include('../../Controller/PlanController.php');
$planController = new PlanController();

$limit = 7;
// Get total tasks to calculate total pages
$totalTasks = $planController->getTotalTasks();
$totalPages = ceil($totalTasks / $limit); // Ensure this rounds up for cases with remainder

// Initialize the current page from session (or default to 1 if not set)
if (!isset($_SESSION['current_page_task'])) {
    $_SESSION['current_page_task'] = 1;
}
// Get the current page from session
$currentPage = $_SESSION['current_page_task'];

// Check if Next or Previous button was clicked
if (isset($_POST['next_task']) && $currentPage < $totalPages) {
    $_SESSION['current_page_task']++; // Increase page number when Next is clicked
} elseif (isset($_POST['previous_task']) && $currentPage > 1) {
    $_SESSION['current_page_task']--; // Decrease page number when Previous is clicked
}

// Calculate the offset for the SQL query
$offset = ($currentPage - 1) * $limit;
$tasks = $planController->listTasks($offset, $limit);
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
    <?php echo "Total Tasks: " . $totalTasks; ?>

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
    <br>
     <!-- Pagination Controls -->
     <form method="post">
        <button type="submit" name="previous_task" <?php if ($currentPage <= 1) echo 'disabled'; ?>>Previous</button>
        <span>Page <?php echo $currentPage; ?> of <?php echo $totalPages; ?></span>
        <button type="submit" name="next_task" <?php if ($currentPage >= $totalPages) echo 'disabled'; ?>>Next</button>
    </form>
</body>
</html>
