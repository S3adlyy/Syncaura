<?php
include 'C:\xampp\htdocs\integration3\controller\achatA.php';

$achatManager = new AchatManager();
$packs = $achatManager->getAllPacks(); // Fetch all packs for ComboBox

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom_user = $_POST['nom_user'];
    $email = $_POST['email'];
    $idPack = $_POST['idPack'];

    $achat = new Achat(null , $nom_user, $email, $idPack);
    $achatManager->addAchat($achat); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Pack</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="styles.css" rel="stylesheet">
    <link rel="stylesheet" href="min.css">
    <script src="scriptAch.js"></script>

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
        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="dash.html">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Interface
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
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
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Addons
        </div>

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
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

            </nav>
<!-- Form for Adding/Editing Achat -->
<form action="" method="POST" onsubmit="return validateForm();" novalidate>>
    <table border="1" align="center">
        <tr>
            <td><label for="nom_user">Nom utilisateur:</label></td>
            <td><input type="text" name="nom_user" id="nom_user" required></td>
        </tr>
        <tr>
            <td><label for="email">Email:</label></td>
            <td><input type="email" name="email" id="email" required></td>
        </tr>
        <tr>
            <td><label for="idPack">Pack:</label></td>
            <td>
                <select name="idPack" id="idPack" required>
                    <?php foreach ($packs as $pack): ?>
                        <option value="<?php echo $pack['id']; ?>"><?php echo $pack['nom']; ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr align="center">
            <td><input type="submit" value="Save"></td>
            <td><input type="reset" value="Reset"></td>
        </tr>
    </table>
</form>
