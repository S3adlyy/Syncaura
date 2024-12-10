<?php
session_start();
include_once "../../../controller/plancontroller.php";

$planController = new PlanController();

// Set the number of results per page
$limit = 10;
// Get total plans to calculate total pages
$totalPlans = $planController->getTotalPlans();
echo "Total Plans: " . $totalPlans;  // Add this line to debug
$totalPages = ceil($totalPlans / $limit); // Ensure this rounds up for cases with remainder

// Initialize the current page from session (or default to 1 if not set)
if (!isset($_SESSION['current_page'])) {
    $_SESSION['current_page'] = 1;
}
// Get the current page from session
$currentPage = $_SESSION['current_page'];

// Check if Next or Previous button was clicked
if (isset($_POST['next']) && $currentPage < $totalPages) {
    $_SESSION['current_page']++; // Increase page number when Next is clicked
} elseif (isset($_POST['previous']) && $currentPage > 1) {
    $_SESSION['current_page']--; // Decrease page number when Previous is clicked
}
// Calculate the offset for the SQL query
$offset = ($currentPage - 1) * $limit;

// Get filters from the request (for example, from a search form)
$nameFilter = isset($_POST['nameFilter']) ? '%' . $_POST['nameFilter'] . '%' : '';
$dateFilter = isset($_POST['dateFilter']) ? $_POST['dateFilter'] : '';

// Get the list of plans with filters
$plans = $planController->listPlansWithFilter($offset, $limit, $nameFilter, $dateFilter);

?>

<!-- Link to external CSS file -->
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
<br>
<form method="post">
    <input type="text" name="nameFilter" placeholder="Filter by plan name">
    <input type="date" name="dateFilter" placeholder="Filter by date">
    <button type="submit">Apply Filters</button>
</form>
<br>
<!-- Updated table with custom styles -->
<table class="custom-table">
    <thead>
        <tr>
            <th>Plan Name</th>
            <th>Date Created</th>
            <th>Modification Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($plans as $plan): ?>
                <?php
                    $dateCreated = new DateTime($plan['date_plan']);
                    $dateModified = $dateCreated->diff(new DateTime());
                    $currentDate = new DateTime();
                    $formattedCurrentDate = $currentDate->format('Y-m-d H:i:s');
                    $modificationDate = $dateModified->format('%d days ago');
                ?>
                <tr>
                    <td><?= $plan['nom']; ?></td>
                    <td><?= $plan['date_plan']; ?></td>
                    <td><?= $formattedCurrentDate; ?>  <?= $modificationDate; ?></td>
                    <td>
                        <a href="deleteplan.php?nom=<?= urlencode($plan['nom']); ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this plan?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
    </tbody>
</table>
<br>
 <!-- Pagination buttons -->
 <div class="pagination">
        <!-- Previous Button -->
        <?php if ($currentPage > 1): ?>
            <form method="post">
                <button type="submit" name="previous">Previous</button>
            </form>
        <?php endif; ?>

        <!-- Display the current page -->
        <span>Page <?= $currentPage ?> of <?= $totalPages ?></span>

        <!-- Next Button -->
        <?php if ($currentPage < $totalPages): ?>
            <form method="post">
                <button type="submit" name="next">Next</button>
            </form>
        <?php endif; ?>

    </div>
