<?php
include('../../controller/plancontroller.php');
$planController = new PlanController();
$plans = $planController->listPlans();

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
                // Calculate the modification date (based on the created date)
                $dateCreated = new DateTime($plan['date_plan']);
                $dateModified = $dateCreated->diff(new DateTime()); // Difference between created date and now
                
                // Get the current date in "yyyy-mm-dd" format
                $currentDate = new DateTime();
                $formattedCurrentDate = $currentDate->format('Y-m-d');

                // Calculate the number of days since creation
                $modificationDate = $dateModified->format('%d days ago');
            ?>
            <tr>
                <td><?= $plan['nom']; ?></td>
                <td><?= $plan['date_plan']; ?></td>
                <td>
                    <?= $formattedCurrentDate; ?> <br> <?= $modificationDate; ?> <!-- Display both date and days ago -->
                </td>
                <td>
                    <a href="deleteplan.php?nom=<?php echo urlencode($plan['nom']); ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this plan?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
