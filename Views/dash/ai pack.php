<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Syncora Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="styles/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="scriptPack.js"></script>
  <style>
    h1 {
      color: #004080;
      font-size: 2rem;
      margin-bottom: 20px;
      text-align: center;
      font-weight: 600;
    }

    form {
      background-color: #fff;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
      max-width: 600px;
      width: 100%;
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    label {
      font-size: 1.1em;
      color: #333;
      font-weight: 500;
    }

    input[type="text"] {
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 1em;
      width: 100%;
      margin-bottom: 10px;
    }

    button {
      padding: 12px 20px;
      background-color: #004080;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 1.1em;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #003060;
    }

    #responseOutput {
      margin-top: 30px;
      background-color: #ffffff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
      max-width: 600px;
      width: 100%;
      color: #003060;
      font-size: 1.1em;
      text-align: center;
      font-weight: 500;
    }

    .back-button {
      margin-top: 20px;
      padding: 8px 15px; /* Reduced padding for shorter button */
      background-color: #ff6f61;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 1em; /* Slightly smaller font size */
      cursor: pointer;
      text-align: center;
      transition: background-color 0.3s ease;
    }

    .back-button:hover {
      background-color: #d04b3e;
    }
  </style>
</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
       
       <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
           <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dash.html">
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
           <li class="nav-item">
           <a class="nav-link" href="admin/admin_dasboard/users.php">
                   <i class="fas fa-fw fa-cog"></i>
                   <span>Users</span>
               </a>
               <a class="nav-link collapsed" href="table_Chatuser.php" data-toggle="collapse" data-target="#collapseTwo"
                   aria-expanded="true" aria-controls="collapseTwo">
                   <i class="fas fa-fw fa-cog"></i>
                   <span>Chat users</span>
               </a>
               <a class="nav-link collapsed" href="table_messages.php" data-toggle="collapse" data-target="#collapseTwo"
                   aria-expanded="true" aria-controls="collapseTwo">
                   <i class="fas fa-fw fa-cog"></i>
                   <span>Chat messages</span>
               </a>
               <a class="nav-link collapsed" href="fetch.php" data-toggle="collapse" data-target="#collapseTwo"
                   aria-expanded="true" aria-controls="collapseTwo">
                   <i class="fas fa-fw fa-cog"></i>
                   <span>users and messages </span>
               </a>
               <a class="nav-link collapsed" href="listPack.php" data-toggle="collapse" data-target="#collapseUtilities"
                   aria-expanded="true" aria-controls="collapseUtilities">
                   <i class="fas fa-fw fa-wrench"></i>
                   <span>Gestion Packs</span>
               </a>
               <a class="nav-link collapsed" href="recherche.php" data-toggle="collapse" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
               <i class="fas fa-fw fa-wrench"></i>
               <span>recherche  Achats</span>
           </a>
           <a class="nav-link collapsed" href="ai pack.php" data-toggle="collapse" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
               <i class="fas fa-fw fa-wrench"></i>
               <span>ai description pack</span>
           </a>

           <a class="nav-link collapsed" href="send.php" data-toggle="collapse" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
               <i class="fas fa-fw fa-wrench"></i>
               <span>Mailing</span>
           </a>
           <a class="nav-link collapsed" href="listAchat.php" data-toggle="collapse" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
               <i class="fas fa-fw fa-wrench"></i>
               <span>Gestion Achats</span>
           </a>
           <a class="nav-link collapsed" href="dashboard.php" data-toggle="collapse" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
               <i class="fas fa-fw fa-wrench"></i>
               <span>Blog</span>
           </a>
           <a class="nav-link collapsed" href="dash_support/table_questions.php" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-question"></i>
                    <span >question support</span>
                </a>

                <a class="nav-link collapsed" href="dash_support/table_reponse.php" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-reply"></i>
                    <span >response support</span>
                </a>
                <a class="nav-link collapsed" href="dash_todo/plandash.php" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Manage Plans </span>
                </a>
                <a class="nav-link collapsed" href="dash_todo/taskdash.php" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Manage Tasks </span>
                </a>
                <a class="nav-link collapsed" href="dash_todo/searchtaskdash.php" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Search Tasks </span>
                </a>
       </ul>

<?php include 'admin_header.php'; ?>->

    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->
            </nav>
    

  <h1 style="margin-right: 550px;">Générateur de description pour les packs</h1>
  <form action="" method="POST" >
    <label for="inputText">Entrez le nom du pack :</label>
    <input type="text" id="inputText" name="inputText" required>
    <button type="submit">Générer</button>
  </form>

  <div id="responseOutput">
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $inputText = $_POST['inputText'] ?? ''; // Récupère le texte envoyé depuis le formulaire
        if (!empty($inputText)) {
            // Clé API et URL de l'API
            $apiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=AIzaSyCAg4jKbmmb0jjIK-kYnGYqN8sCMi_xaa8";

            // Préparer le corps de la requête pour une réponse courte
            $requestBody = [
                "contents" => [
                    [
                        "parts" => [
                            ["text" => "Create a short description for the following pack: " . $inputText]
                        ]
                    ]
                ]
            ];

            // Initialiser cURL
            $ch = curl_init($apiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Content-Type: application/json"
            ]);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestBody));

            // Exécuter la requête et récupérer la réponse
            $response = curl_exec($ch);

            if ($response === false) {
                echo "Erreur cURL : " . curl_error($ch);
            } else {
                // Traiter la réponse API
                $data = json_decode($response, true);

                // Vérifier si la réponse contient le texte généré
                if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                    echo htmlspecialchars($data['candidates'][0]['content']['parts'][0]['text']);
                } else {
                    echo "Erreur : Réponse inattendue de l'API.";
                }
            }
            curl_close($ch);
        } else {
            echo "Erreur : aucun texte fourni.";
        }
    } else {
        echo "Aucune description générée pour l'instant...";
    }
    ?>
  </div>

  <!-- Bouton retour -->
  <button class="back-button" onclick="window.location.href='dach.html';">Retour</button>

</body>
</html>





