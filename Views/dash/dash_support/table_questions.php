<?php
include 'C:\xampp\htdocs\integration3\configg.php';
include 'C:\xampp\htdocs\integration3\controller\questionsC.php';

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
        body {
            background-color: #e8eaf0;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .cool-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .cool-table th, .cool-table td {
            padding: 12px 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .cool-table th {
            background-color: #355ccc;
            color: white;
        }
        .cool-table tr:nth-child(even) {
            background-color: #f9f9f9;

        }
        .cool-table tr:hover {
            background-color: #f1f1f1;

        }
        .cool-table .delete-btn, .cool-table .modify-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 50px;
            cursor: pointer;
            font-size: 14px;
            text-transform: uppercase;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .cool-table .modify-btn {
            background-color: #4caf50; /* Green for modify */
        }

        .cool-table .delete-btn:hover, .cool-table .modify-btn:hover {
            background-color: #d32f2f;
            transform: translateY(-2px);
        }

        .cool-table .delete-btn:active, .cool-table .modify-btn:active {
            transform: translateY(1px);
        }

        .cool-table td input[type="hidden"] {
            display: none;
        }


        /* Additional responsiveness */
        @media (max-width: 768px) {
            .cool-table {
                width: 95%;
                margin: 20px;
            }
        }
    .modify-btn {
    background-color: #4e73df;
    color: white;
    border: none;
    padding: 10px 18px;
    border-radius: 50px;
    cursor: pointer;
    font-size: 14px;
    text-transform: uppercase;
    transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .modify-btn:hover {
    background-color: #3e63b3;
    transform: translateY(-2px);
    }

    .modify-btn:active {
    transform: translateY(1px);
    }
    </style>

<style>
.img {
    width: 80px; /* Adjust to your preferred size */
    height: 50px; /* Maintain a square aspect ratio */
    border-radius: 80%; /* Circular shape */
    overflow: hidden; /* Ensures the image fits within the circle */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08); /* Adds a soft shadow */
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth hover animations */
    margin-right:80px;
}

.img img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ensures the image fills the circle */
}

.img:hover {
    transform: scale(1.1); /* Slightly zoom in on hover */
    box-shadow: 0 8px 10px rgba(0, 0, 0, 0.15), 0 3px 6px rgba(0, 0, 0, 0.12); /* Stronger shadow on hover */
}

    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
       
       <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
           <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dash.html">
              
               <div class="img">
                <img src="imgggg.png" alt="syncauralogo">
               </div>
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
           <a class="nav-link" href="../admin/admin_dasboard/users.php">
                   <i class="fas fa-fw fa-cog"></i>
                   <span>Users</span>
               </a>
               <a class="nav-link collapsed" href="../table_Chatuser.php" data-toggle="collapse" data-target="#collapseTwo"
                   aria-expanded="true" aria-controls="collapseTwo">
                   <i class="fas fa-fw fa-cog"></i>
                   <span>Chat users</span>
               </a>
               <a class="nav-link collapsed" href="../table_messages.php" data-toggle="collapse" data-target="#collapseTwo"
                   aria-expanded="true" aria-controls="collapseTwo">
                   <i class="fas fa-fw fa-cog"></i>
                   <span>Chat messages</span>
               </a>
               <a class="nav-link collapsed" href="../fetch.php" data-toggle="collapse" data-target="#collapseTwo"
                   aria-expanded="true" aria-controls="collapseTwo">
                   <i class="fas fa-fw fa-cog"></i>
                   <span>users and messages </span>
               </a>
               <a class="nav-link collapsed" href="../listPack.php" data-toggle="collapse" data-target="#collapseUtilities"
                   aria-expanded="true" aria-controls="collapseUtilities">
                   <i class="fas fa-fw fa-wrench"></i>
                   <span>Gestion Packs</span>
               </a>
               <a class="nav-link collapsed" href="../recherche.php" data-toggle="collapse" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
               <i class="fas fa-fw fa-wrench"></i>
               <span>recherche  Achats</span>
           </a>
           <a class="nav-link collapsed" href="../ai pack.php" data-toggle="collapse" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
               <i class="fas fa-fw fa-wrench"></i>
               <span>ai description pack</span>
           </a>

           <a class="nav-link collapsed" href="../send.php" data-toggle="collapse" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
               <i class="fas fa-fw fa-wrench"></i>
               <span>Mailing</span>
           </a>
           <a class="nav-link collapsed" href="../listAchat.php" data-toggle="collapse" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
               <i class="fas fa-fw fa-wrench"></i>
               <span>Gestion Achats</span>
           </a>
           <a class="nav-link collapsed" href="../dashboard.php" data-toggle="collapse" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
               <i class="fas fa-fw fa-wrench"></i>
               <span>Blog</span>
           </a>
           <a class="nav-link collapsed" href="table_questions.php" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-question"></i>
                    <span >question support</span>
                </a>

                <a class="nav-link collapsed" href="table_reponse.php" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-reply"></i>
                    <span >response support</span>
                </a>
                <a class="nav-link collapsed" href="../dash_todo/plandash.php" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Manage Plans </span>
                </a>
                <a class="nav-link collapsed" href="../dash_todo/taskdash.php" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Manage Tasks </span>
                </a>
                <a class="nav-link collapsed" href="../dash_todo/searchtaskdash.php" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Search Tasks </span>
                </a>

       </ul>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">questions Support </h1>
                    <!-- Add Question Button -->
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
