<?php

session_start();
include_once "../../../controller/plancontroller.php";
$planController = new PlanController();

$limit = 10;
// Get filters from the request 
$nameFilter = isset($_POST['nameFilter']) ? '%' . $_POST['nameFilter'] . '%' : '';
$dateFilter = isset($_POST['dateFilter']) ? $_POST['dateFilter'] : '';
$etatFilter = isset($_POST['etatFilter']) ? '%' . $_POST['etatFilter'] . '%' : '';

// Get the total count of filtered tasks for pagination
$totalFilteredTasks = $planController->getTotalFilteredTasks($nameFilter, $dateFilter, $etatFilter);

// Calculate total pages based on filtered tasks
$totalPages = ceil($totalFilteredTasks / $limit);

// Get the current page from session
if (!isset($_SESSION['current_page_task'])) {
    $_SESSION['current_page_task'] = 1;
}
$currentPage = $_SESSION['current_page_task'];

// Check if Next or Previous button was clicked
if (isset($_POST['next_task']) && $currentPage < $totalPages) {
    $_SESSION['current_page_task']++; // Increase page number when Next is clicked
} elseif (isset($_POST['previous_task']) && $currentPage > 1) {
    $_SESSION['current_page_task']--; // Decrease page number when Previous is clicked
}

// Calculate the offset for the SQL query based on the filtered tasks
$offset = ($currentPage - 1) * $limit;

// Get the list of tasks with filters and pagination
$tasks = $planController->listTasksWithFilter($offset, $limit, $nameFilter, $dateFilter, $etatFilter);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>

    <link rel="stylesheet" href="styleplandash.css">
    <style>
        body {
            background-color: #f4f7fc;
            color: #333;
            margin: 0;
            padding: 0;
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
    
    
    </style>

    
</head>
<body align="center">
    <br>
    <?php echo "Total Tasks: " . $totalFilteredTasks; ?>
    <form method="post">
    <input type="text" name="nameFilter" placeholder="Filter by task name">
    <input type="date" name="dateFilter" placeholder="Filter by date">
    <input type="text" name="etatFilter" placeholder="Filter by status">
    <button type="submit">Apply Filters</button>
</form>

<!-- Display filtered task list and pagination -->
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
    <br>
     <!-- Pagination Controls -->
     <form method="post">
        <button type="submit" name="previous_task" <?php if ($currentPage <= 1) echo 'disabled'; ?>>Previous</button>
        <span>Page <?php echo $currentPage; ?> of <?php echo $totalPages; ?></span>
        <button type="submit" name="next_task" <?php if ($currentPage >= $totalPages) echo 'disabled'; ?>>Next</button>
    </form>
</body>
</html>
