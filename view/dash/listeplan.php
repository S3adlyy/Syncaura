<?php
include('../../Controller/PlanController.php');
$planController = new PlanController();
$plans = $planController->listPlans();
?>

<!-- Link to external CSS file -->
<link rel="stylesheet" href="styleplandash.css">

<a href="addplan.php"  style="font-weight: bold; font-size: 20px;" >Add New Plan</a>
<br> <br>
<!-- Updated table with custom styles -->
<table class="custom-table">
    <thead>
        <tr>
            <th>Plan ID</th>
            <th>Plan Name</th>
            <th>Date Created</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($plans as $plan): ?>
            <tr>
                <td><?= $plan['id']; ?></td>
                <td><?= $plan['nom']; ?></td>
                <td><?= $plan['date_plan']; ?></td>
                <td>
                    <a href="deleteplan.php?id=<?= $plan['id']; ?>" class="btn-delete">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
