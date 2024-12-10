<?php
include_once "../../../controller/plancontroller.php";
$planController = new PlanController();
$id = $_GET['id'];
$plan = $planController->listPlans();
$planToModify = null;

foreach ($plan as $p) {
    if ($p['id'] == $id) {
        $planToModify = $p;
        break;
    }
}

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
        $planController->modifyPlan($id, $nom); // Updates both plan and tasks
        header('Location: todolist.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="imgggg.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Plan</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.8); /* White with transparency */
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
            width: 400px;
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
            width: calc(100% - 20px);
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
<body>
    <div class="form-container">
        <h2>Add the New Plan Name</h2>
        <form method="POST" action="">
            <label for="nom"></label>
            <input type="text" name="nom" id="nom" value="<?= $planToModify['nom']; ?>" placeholder="Enter plan name" >
            <?php if ($errorMessage): ?>
                <p style="color: red;"><?= $errorMessage; ?></p>
            <?php endif; ?>
            <input type="submit" value="Modify Plan">
        </form>
    </div>
</body>
</html>
