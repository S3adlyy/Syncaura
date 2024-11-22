<?php
include('../../Controller/PlanController.php');

// Create an instance of the PlanController
$planController = new PlanController();

$plans = $planController->listPlans();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_plan'])) {
    // Validate plan name (server-side validation)
    $nom = $_POST['nom'];
    $errors = [];

    if (empty($nom)) {
        $errors[] = "Plan name should not be empty.";
    }

    if (preg_match('/[^a-zA-Z0-9 ]/', $nom)) {
        $errors[] = "Plan name should not contain special characters.";
    }

    if (is_numeric(substr($nom, 0, 1))) {
        $errors[] = "Plan name should not start with a number.";
    }

    // If no errors, proceed to add the plan
    if (empty($errors)) {
        $date_plan = date('Y-m-d'); 
        $planController->addPlan($nom, $date_plan);
        header('Location: todo.php'); 
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Plans</title>
    <link rel="stylesheet" href="styleplan.css">
    
</head>
<body>
    <div class="container">
        <h1>My Plans</h1>

        <!-- Add Plan Form -->
        <div class="add-plan-container">
            <h2>Add your plan name</h2>
            <form method="POST" action="">
                <input type="text" name="nom" id="plan_name" placeholder="Enter plan name" 
                       value="<?php echo isset($nom) ? htmlspecialchars($nom) : ''; ?>">
                <button type="submit" name="add_plan" id="add_plan_button">Add Plan</button>
            </form>
            <?php if (!empty($errors)): ?>
                <div class="error-messages">
                    <?php foreach ($errors as $error): ?>
                        <p style="color: red;"><?php echo $error; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- List of Plans -->
        <div align="center" class="plans-container">
            <h2>Your Plans</h2>
            <table class="plans-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($plans as $plan): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($plan['nom']); ?></td>
                            <td>
                                <a href="modifyplan.php?id=<?php echo $plan['id']; ?>" class="btn modify-btn">Modify</a>
                                <a href="deleteplan.php?id=<?php echo $plan['id']; ?>" class="btn delete-btn" onclick="return confirm('Are you sure you want to delete this plan?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
