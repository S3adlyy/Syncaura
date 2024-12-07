<?php
include 'C:\wamp64\www\crud kooli\config.php';
include 'C:\wamp64\www\crud kooli\controller\questionsC.php';

// Instancier le contrôleur questionsC
$questionsC = new questionsC();

// Récupérer les questions
$questions = $questionsC->listquestion();


$critere = isset($_GET['critere']) ? $_GET['critere'] : 'questions';
$ordre = isset($_GET['ordre']) && $_GET['ordre'] === 'DESC' ? 'DESC' : 'ASC';

$questions = $questionsC->trierquestion($critere, $ordre);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Syncora Dashboard</title>

    <!-- Custom fonts and styles -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="styles/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/min.css">

    <style>
        /* Styling for the page */
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fc;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #4e73df;
        }

        .open-form-btn {
            display: block;
            width: 200px;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            margin: 20px auto;
            cursor: pointer;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .open-form-btn:hover {
            background-color: #0056b3;
        }

        /* Form Styling */
        .form-container {
            display: none;
            margin-top: 20px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .form-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #218838;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4e73df;
            color: white;
        }

        td {
            background-color: #fff;
            color:black;
        }

        tr:nth-child(even) td {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: blue;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Syncora <sup>2</sup></div>
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

            <a class="nav-link collapsed" href="table_questions.php" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-question"></i>
                    <span style="background color:white; color:white;">question support</span>
                </a>
                <a class="nav-link collapsed" href="table_reponse.php" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-reply"></i>
                    <span style="background color:white; color:white;">response support</span>
                </a>
        </ul>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">questions Support </h1>
                    <!-- Add Question Button -->
                    <button class="open-form-btn" onclick="window.location.href='form_questions.php'"><i class="fa fa-plus"></i>Add New Question</button>
                    <!-- Table for Questions -->
                    <form method="GET" action="" style="margin: 20px;">
    
    <select name="critere" style="padding: 8px;border-radius: 5px;border: 1px solid #ccc;margin-left: 550px;">
        <option value="questions" <?= (isset($_GET['critere']) && $_GET['critere'] == 'questions') ? 'selected' : '' ?>>questions</option>
        <option value="Date_Creation" <?= (isset($_GET['critere']) && $_GET['critere'] == 'Date_Creation') ? 'selected' : '' ?>>Date de Création</option>
        <option value="type" <?= (isset($_GET['critere']) && $_GET['critere'] == 'type') ? 'selected' : '' ?>>Type</option>
    </select>
    <button type="submit" 
        style="background-color: blue; color: white; border-radius: 5px; cursor: pointer; padding: 5px 10px; font-size: 12px;" 
        name="ordre" 
        value="<?= (isset($_GET['ordre']) && $_GET['ordre'] === 'ASC') ? 'DESC' : 'ASC'; ?>"><i class="fa fa-sort">Trier</i></button></form>

        <i class="fa fa-sort"></i>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All questions</h6>
                        </div>
                        <div class="card-body">
                            <table>
                                <thead>
                                    <tr>
                                        <th>id_question</th>
                                        <th>questions</th>
                                        <th>date_creation</th>
                                        <th>id</th>
                                        <th>type</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
// Afficher les questions dynamiquement
foreach ($questions as $question) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($question['id_question']) . "</td>";
    echo "<td>" . htmlspecialchars($question['questions']) . "</td>";
    echo "<td>" . htmlspecialchars($question['date_creation']) . "</td>";
    echo "<td>" . htmlspecialchars($question['id']) . "</td>";
    echo "<td>" . htmlspecialchars($question['type']) . "</td>";
    echo "<td>
        <button class='button1' onclick=\"window.location.href = 'modifierQuestion.php?id=" . $question['id_question'] . "';\"><i class='fa fa-edit' style='color:blue;'></i></button>
        <button class='button1' onclick=\"window.location.href = 'suppressionQuestion.php?id=" . $question['id_question'] . "';\"><i class='fa fa-trash' style='color:red;'></i></button>
        <button class='button1' onclick=\"window.location.href = 'AfficherQuestion.php?id=" . $question['id_question'] . "';\"><i class='fa fa-eye' style='color:forestgreen;'></i></button>
    </td>";
    echo "</tr>";
}
?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript to Toggle Form Visibility -->
    <script>
        function toggleForm() {
            var formContainer = document.getElementById("formContainer");
            if (formContainer.style.display === "none" || formContainer.style.display === "") {
                formContainer.style.display = "block";  // Show the form
            } else {
                formContainer.style.display = "none";   // Hide the form
            }
        }
    </script>

    <!-- JavaScript files -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>
