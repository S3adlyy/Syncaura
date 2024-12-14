<?php
session_start();
include_once "../../../controller/plancontroller.php";


$planController = new PlanController();

// Set the number of results per page
$limit = 4;
// Get total plans to calculate total pages
$totalPlans = $planController->getTotalPlans();
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
///////////////////////////////////////////////////////////////////
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_plan'])) {

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

    // Check if plan name already exists in the database
    $existingPlan = $planController->getPlanByName($nom);
    if ($existingPlan) {
        $errors[] = "A plan with this name already exists.";
    }

    // If no errors, proceed to add the plan
    if (empty($errors)) {
        $date_plan = date('Y-m-d');
        $planController->addPlan($nom, $date_plan);
        header("Location: todotasks.php?planName=$nom");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="imgggg.png">
    <title>My Plans</title>
    <link rel="stylesheet" href="styleplan.css">
    <style>
    .form-input {
        margin-top: 20px;
        margin-bottom: 20px;
        text-align: center;
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
            background-color:#000733;
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
<body>
    <div align="center" class="container" style="width:1000px; margin: 0;padding: 0; margin-left:260px;">
        <!-- Add Plan Form -->
        <div  style="height:220px;" class="add-plan-container">
            <br>
            <h2>Add your plan name</h2>
            <form method="POST" action="" style="form-input">
                <input type="text" name="nom" id="plan_name" placeholder="Enter plan name" 
                       value="<?php echo isset($nom) ? htmlspecialchars($nom) : ''; ?>">
                    <br> 
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
                        <br>
        <!-- List of Plans -->
        <div style="width:1000px;margin: 0;padding: 10px;" class="plans-container">
            <h2>Your Plans</h2>
            <?php echo "Total Plans: " . $totalPlans; ?>
            <br>
            <!-- Pagination buttons -->
            <div style="text-align:right;" class="pagination">
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
            <table style="" class="custom-table">
                <thead>
                    <tr>
                        <th>Name</th>
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
                            <td>
                                <a href="todotasks.php?planName=<?php echo urlencode($plan['nom']); ?>" class="plan-link" style="text-decoration: none; color: #000733; font-weight: bold;">
                                    <?php echo htmlspecialchars($plan['nom']); ?>
                                </a></td>
                            <td><?= $plan['date_plan']; ?></td>
                            <td><?= $formattedCurrentDate; ?> <br> <?= $modificationDate; ?></td>
                            <td>
                                <a href="modifyplan.php?id=<?php echo $plan['id']; ?>" class="btn modify-btn">Modify</a>
                                <a href="deleteplan.php?nom=<?php echo urlencode($plan['nom']); ?>"class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this plan?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
           
        </div>
    </div>
</body>
</html>
