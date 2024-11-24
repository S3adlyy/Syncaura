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
                    <span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">Tables</div>
            <li class="nav-item">
                <a class="nav-link" href="dash.php">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Client Support</span>
                </a>
            </li>
        </ul>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Client Support Messages</h1>
                    <button class="add-course-btn" onclick="window.location.href='add_msg.php'">
                        <i class="fa fa-plus" style="color: green"></i> Ajouter un cours
                    </button>

                    <!-- Read Messages -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Messages</h6>
                        </div>
                        <div class="card-body">
                        <?php
// Include database connection
include 'C:\xampp\htdocs\Crud Doudou\doudou\config.php';

try {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=contact', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo 'La connexion à la base de données a échoué: ' . $e->getMessage();
        exit;
    }
    if (!isset($pdo)) {
        throw new Exception("Database connection is not established.");
    }

    $stmt = $pdo->query("SELECT * FROM gcontacte");
    $messages = $stmt->fetchAll();

    if (count($messages) > 0) {
        echo '<table class="table table-bordered">';
        echo '<thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Message</th><th>Actions</th></tr></thead><tbody>';
        foreach ($messages as $message) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($message['id']) . '</td>';
            echo '<td>' . htmlspecialchars($message['name']) . '</td>';
            echo '<td>' . htmlspecialchars($message['email']) . '</td>';
            echo '<td>' . htmlspecialchars($message['message']) . '</td>';
            echo '<td>
                <form action="update_msg.php" method="POST" style="display:inline-block;">
                    <input type="hidden" name="id" value="' . htmlspecialchars($message['id']) . '">
                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                </form>
                <button onclick="window.location.href = \'delete_message.php?id=' . $message['id'] . '\';"><i class="fa fa-trash" style="color:red;"></i></button>
            </td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
    } else {
        echo '<p>No messages found.</p>';
    }
} catch (Exception $e) {
    echo '<p>Error: ' . htmlspecialchars($e->getMessage()) . '</p>';
}
?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript files -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>
