<?php
session_start();

// Database connection
$dsn = "mysql:host=localhost;dbname=users";
$db_user = "root";
$db_password = "";

try {
    $connect = new PDO($dsn, $db_user, $db_password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Handle Delete Action
    if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $connect->prepare("DELETE FROM client WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        header("Location: dash.php");
        exit();
    }

    // Handle Lock Account (status = 0)
    if (isset($_GET['action']) && $_GET['action'] == 'lock' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $connect->prepare("UPDATE client SET status = 0 WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        header("Location: dash.php");
        exit();
    }

    // Handle Unlock Account (status = 1)
    if (isset($_GET['action']) && $_GET['action'] == 'unlock' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $connect->prepare("UPDATE client SET status = 1 WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        header("Location: dash.php");
        exit();
    }

    // Fetch all clients
    $stmt = $connect->query("SELECT id, name, email, password, status FROM client WHERE role != 1");
    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Database Error: ' . $e->getMessage();
    exit();
}

// Ensure user is logged in
if (!isset($_SESSION["user_id"])) {
    echo "You must be logged in to access this page.";
    exit();
}
?>

<!doctype html>
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
    <link rel="stylesheet" href="css/style.css">
</head>
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
                <a class="nav-link" href="dash.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Tables
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="users.php" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Users</span>
                </a>
                <li class="nav-item">
                <a class="nav-link collapsed" href="../../Table_Chatuser.php" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Chat users</span>
                </a>
                <a class="nav-link collapsed" href="../../table_messages.php" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Chat messages</span>
                </a>
                <a class="nav-link collapsed" href="../../fetch.php" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>users and messages </span>
                </a>
            <!-- Nav Item - Utilities Collapse Menu -->
<script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
</body>
</html>
