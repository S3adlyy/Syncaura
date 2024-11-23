<?php
include 'C:\xampp1\htdocs\projetrayen\controller\achatA.php';

$achatManager = new AchatManager();
$packs = $achatManager->getAllPacks(); // Fetch all packs for ComboBox

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom_user = $_POST['nom_user'];
    $email = $_POST['email'];
    $prixFinale = $_POST['prixFinale'];
    $idPack = $_POST['idPack'];

    $achat = new Achat(null , $nom_user, $email, $prixFinale, $idPack);
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

</head>
<body>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Syncora <sup>2</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="index.html">
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
            <a class="nav-link collapsed" href="listPack.php" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Gestion Packs</span>
            </a>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="listAchat.php" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Gestion Achats</span>
            </a>
        </li>

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
            <td><label for="prixFinale">Prix Finale:</label></td>
            <td><input type="number" name="prixFinale" id="prixFinale" step="0.01" required></td>
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
