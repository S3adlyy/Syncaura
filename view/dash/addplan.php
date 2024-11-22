<?php
include('../../Controller/PlanController.php');
$planController = new PlanController();
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = trim($_POST['nom']);
    if (empty($nom)) {
        $errorMessage = 'Plan name cannot be empty';
    } elseif (preg_match('/^[0-9]/', $nom)) {
        $errorMessage = 'Plan name should not start with a number';
    } elseif (preg_match('/[^a-zA-Z0-9 ]/', $nom)) {
        $errorMessage = 'Plan name should not contain special characters';
    } else {
        $planController->addPlan($nom);
        header('Location: listeplan.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Plan</title>
    <!-- Custom fonts and styles for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="styles/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            height: 100vh;
        }

        #wrapper {
            display: flex;
            width: 100%;
        }

        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            padding: 20px;
            height: 100vh;
        }

        .container-fluid {
            flex: 1;
            margin-left: 250px;
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 600px;
            text-align: center;
        }

        .form-container h2 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: #000733;
        }

        .form-container label {
            display: block;
            margin-bottom: 8px;
            font-size: 1rem;
            color: #333;
        }

        .form-container input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .form-container p {
            margin-top: -10px;
            margin-bottom: 15px;
            font-size: 0.9rem;
        }

        .form-container input[type="submit"] {
            background-color: #000733;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-container input[type="submit"]:hover {
            background-color: #001144;
        }
    </style>
</head>
<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dash.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Syncaura</div>
            </a>

            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="dash.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Tables
            </div>
            <li class="nav-item">
                <a class="nav-link" href="plandash.php">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Manage Plans</span>
                </a>
                <a class="nav-link" href="taskdash.php">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Manage Tasks</span>
                </a>
            </li>
        </ul>

        <!-- Content Area -->
        <div class="container-fluid">
            <div class="form-container">
                <h2>Add A Plan</h2>
                <form method="POST" action="">
                    <label for="nom"></label>
                    <input type="text" name="nom" id="nom" placeholder="Enter plan name" value="<?= isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : '' ?>" >
                    <?php if ($errorMessage): ?>
                        <p style="color: red;"><?= $errorMessage; ?></p>
                    <?php endif; ?>
                    <input type="submit" value="Add Plan">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
