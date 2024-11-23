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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="imggg.png">
    <link href="https://fonts.googleapis.com/css2?family=Display+Playfair:wght@400;700&family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Client Management</title>
</head>
<body>

<!-- Navigation -->
<nav class="site-nav mb-5">
    <div class="pb-2 top-bar mb-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-6 col-lg-9">
                    <a href="#" class="small mr-3">Contacter les développeurs</a>
                    <a href="#" class="small mr-3">+216 54171319</a>
                    <a href="./contact/loding2.php" class="small mr-3">Contact Us Via Email</a>
                </div>
            </div>
        </div>
    </div>
    <div class="sticky-nav js-sticky-header">
        <div class="container position-relative">
            <div class="site-navigation text-center">
                <a href="index.html" class="logo">SyncAura<span class="text-primary">.</span></a>
                <ul class="js-clone-nav site-menu">
                    <li><a href="./voicee/loadng1.php">Créer un meet</a></li>
                    <li><a href="./Ai/loding3.php">AI ChatBot</a></li>
                    <li><a href="./promodor/index.php">Pomodoro Timer</a></li>
                    <li><a href="./chat/lodingchat.php">Chat</a></li>
                    <li><a href="todo.php">To-Do List</a></li>
                    <li><a href="../user_modify/main.php">Modifier Compte</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- Hero Section with Background Image -->
<div class="untree_co-hero overlay" style="background-image: url('images/hero-img-1-min.jpg');">
    <div class="container">
        
    </div>
</div>

<!-- Client Management Table -->
<div class="container mt-5">
    <h2 class="text-center mb-4">Client Management</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>

                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($clients)): ?>
                <?php foreach ($clients as $client): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($client['id']); ?></td>
                        <td><?php echo htmlspecialchars($client['name']); ?></td>
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
                    <td colspan="6" class="text-center">No clients found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Footer -->
<footer class="text-center mt-5">
    <p>© 2024 SyncAura. All rights reserved.</p>
</footer>

<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
