<?php
session_start();
include('../../controller/plancontroller.php');
$planController = new PlanController();

// Set the number of results per page
$limit = 7;
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
$plans = $planController->listPlans($offset, $limit);
?>

<!-- Link to external CSS file -->
<link rel="stylesheet" href="styleplandash.css">
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
                    $formattedCurrentDate = $currentDate->format('Y-m-d');
                    $modificationDate = $dateModified->format('%d days ago');
                ?>
                <tr>
                    <td><?= $plan['nom']; ?></td>
                    <td><?= $plan['date_plan']; ?></td>
                    <td>
                        <?= $formattedCurrentDate; ?> <br> <?= $modificationDate; ?>
                    </td>
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

        <!-- Next Button -->
        <?php if ($currentPage < $totalPages): ?>
            <form method="post">
                <button type="submit" name="next">Next</button>
            </form>
        <?php endif; ?>

        <!-- Display the current page -->
        <span>Page <?= $currentPage ?> of <?= $totalPages ?></span>
    </div>
