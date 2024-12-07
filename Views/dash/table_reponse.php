<?php

include 'C:\wamp64\www\crud kooli\config.php';
include 'C:\wamp64\www\crud kooli\model\Reponse.php';
include 'C:\wamp64\www\crud kooli\controller\reponseC.php';

// Instancier le contrôleur questionsC
$repC = new reponseC();

// Récupérer les questions
$rep = $repC->listReponse();

$critere = isset($_GET['critere']) ? $_GET['critere'] : 'contenu';
$ordre = isset($_GET['ordre']) && $_GET['ordre'] === 'DESC' ? 'DESC' : 'ASC';

$rep = $repC->trierreponse($critere, $ordre);
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
        }

        tr:nth-child(even) td {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f1f1f1;
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
                <div class="sidebar-brand-text mx-3">Syncaura <sup>2</sup></div>
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
                    <h1 class="h3 mb-4 text-gray-800">response Support </h1>

                    <!-- Add Question Button -->
                    <button class="open-form-btn" onclick="window.location.href='form_reponse.php'"><i class="fa fa-plus"></i>Add reponse</button>
                    <form method="GET" action="" style="margin: 20px;">
    
    <select name="critere" style="padding: 8px;border-radius: 5px;border: 1px solid #ccc;margin-left: 550px;">
        <option value="contenu" <?= (isset($_GET['critere']) && $_GET['critere'] == 'contenu') ? 'selected' : '' ?>>contenu_reponse</option>
        <option value="date_reponse" <?= (isset($_GET['critere']) && $_GET['critere'] == 'date_reponse') ? 'selected' : '' ?>>date_reponse</option>
        <option value="id_reponse" <?= (isset($_GET['critere']) && $_GET['critere'] == 'id_reponse') ? 'selected' : '' ?>>id_reponse</option>
    </select>
    <button type="submit" 
        style="background-color: blue; color: white; border-radius: 5px; cursor: pointer; padding: 5px 10px; font-size: 12px;" 
        name="ordre" 
        value="<?= (isset($_GET['ordre']) && $_GET['ordre'] === 'ASC') ? 'DESC' : 'ASC'; ?>"><i class="fa fa-sort">Trier</i></button></form>
                    <!-- Table for Questions -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All questions</h6>
                        </div>
                        <div class="card-body">
                        <table>
    <thead>
        <tr>
            <th>id_reponse</th>
            <th>contenu_reponse</th>
            <th>date_reponse</th>
            <th>id question</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Afficher les réponses dynamiquement
        foreach ($rep as $reponse) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($reponse['id_reponse']) . "</td>"; // Affichage de l'id de la réponse
            echo "<td>" . htmlspecialchars($reponse['contenu']) . "</td>"; // Affichage du contenu de la réponse
            echo "<td>" . htmlspecialchars($reponse['date_reponse']) . "</td>"; // Affichage de la date de la réponse
            echo "<td>" . htmlspecialchars($reponse['id_question']) . "</td>"; // Affichage du contenu de la question (via la jointure)
            echo "<td>
                <button class='button1' onclick=\"window.location.href = 'modifierReponse.php?id=" . $reponse['id_reponse'] . "';\"><i class='fa fa-edit' style='color:blue;'></i></button>
                <button class='button1' onclick=\"window.location.href = 'suppressionReponse.php?id=" . $reponse['id_reponse'] . "';\"><i class='fa fa-trash' style='color:red;'></i></button>
                <button class='button1' onclick=\"window.location.href = 'AfficherReponse.php?id=" . $reponse['id_reponse'] . "';\"><i class='fa fa-eye' style='color:forestgreen;'></i></button>
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
