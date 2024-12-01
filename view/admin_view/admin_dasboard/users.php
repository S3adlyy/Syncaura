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
        header("Location: users.php");
        exit();
    }

    // Handle Lock Account (status = 0)
    if (isset($_GET['action']) && $_GET['action'] == 'lock' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $connect->prepare("UPDATE client SET status = 0 WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        header("Location: users.php");
        exit();
    }

    // Handle Unlock Account (status = 1)
    if (isset($_GET['action']) && $_GET['action'] == 'unlock' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $connect->prepare("UPDATE client SET status = 1 WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        header("Location: users.php");
        exit();
    }

    // Fetch all clients
    $stmt = $connect->query("SELECT id, username, email, password, status FROM client WHERE role != 1");
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
    <link rel="stylesheet" href="styles/table.css">
</head>
<body id="page-top">
    <div id="wrapper">
       
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dash.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Syncora <sup>2</sup></div>
            </a>²
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
            <a class="nav-link" href="users.php">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Chat users</span>
                </a>
        </ul>
        <table align="center">
    <caption>Client Management</caption>
    <thead>
        <tr>
            
            <th>userName</th>
            <th>Email</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($clients)): ?>
            <?php foreach ($clients as $client): ?>
                <tr>
                   
                    <td><?php echo htmlspecialchars($client['username']); ?></td>
                    <td><?php echo htmlspecialchars($client['email']); ?></td>
                    <td><?php echo $client['status'] == 1 ? 'Unlocked' : 'Locked'; ?></td>
                    <td>
                        <a href="dash.php?action=delete&id=<?php echo $client['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</a>
                        <?php if ($client['status'] == 1): ?>
                            <a href="dash.php?action=lock&id=<?php echo $client['id']; ?>" class="btn btn-secondary btn-sm">Lock</a>
                        <?php else: ?>
                            <a href="dash.php?action=unlock&id=<?php echo $client['id']; ?>" class="btn btn-success btn-sm">Unlock</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center">No clients found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
</div>


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