<?php
include('../../Controller/PlanController.php');
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
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($plans as $plan): ?>
            <tr>
                <td><?= $plan['nom']; ?></td>
                <td><?= $plan['date_plan']; ?></td>
                <td>
                    <a href="deleteplan.php?nom=<?php echo urlencode($plan['nom']); ?>"class="btn-delete" onclick="return confirm('Are you sure you want to delete this plan?');">Delete</a>

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
