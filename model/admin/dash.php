<?php
// Database connection
$dsn = "mysql:host=localhost;dbname=users";
$user = "root";
$password = "";

try {
    // Establish the database connection
    $connect = new PDO($dsn, $user, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Handle the delete action
    if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
        $id = $_GET['id'];
        // Prepare and execute delete query
        $stmt = $connect->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        // Redirect back to dash.php after delete
        header("Location: dash.php");
        exit();
    }

    // Handle the modify action (update user)
    if (isset($_POST['update']) && isset($_POST['id'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Update the user in the database
        $updateStmt = $connect->prepare("UPDATE users SET name = :name, email = :email, password = :password WHERE id = :id");
        $updateStmt->bindParam(':name', $name);
        $updateStmt->bindParam(':email', $email);
        $updateStmt->bindParam(':password', $password);
        $updateStmt->bindParam(':id', $id);
        $updateStmt->execute();
        // Redirect back to dash.php after update
        header("Location: dash.php");
        exit();
    }

    // Fetch all users
    $stmt = $connect->query("SELECT id, name, email, password FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Database Error: ' . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Syncora Dashboard</title>

    <!-- Custom styles -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="styles.css" rel="stylesheet">
    <style>
        .error-message {
            color: red;
            font-size: 0.85rem;
            margin-top: 5px;
        }
    </style>
</head>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dash.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Syncora</div>
            </a>
        </ul>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">User List</h1>

                    <!-- User Table -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($users)): ?>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                                        <td><?php echo htmlspecialchars($user['name']); ?></td>
                                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                                        <td><?php echo htmlspecialchars($user['password']); ?></td>
                                        <td>
                                            <a href="dash.php?action=modify&id=<?php echo $user['id']; ?>" class="btn btn-warning btn-sm">Modify</a>
                                            <a href="dash.php?action=delete&id=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center">No users found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <!-- Modify User Form -->
                    <?php if (isset($_GET['action']) && $_GET['action'] == 'modify' && isset($_GET['id'])): ?>
                        <?php
                        $userId = $_GET['id'];
                        $stmt = $connect->prepare("SELECT id, name, email, password FROM users WHERE id = :id");
                        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
                        $stmt->execute();
                        $userToModify = $stmt->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <?php if ($userToModify): ?>
                            <h2>Modify User</h2>
                            <form id="modifyUserForm" method="POST" action="dash.php">
                                <input type="hidden" name="id" value="<?php echo $userToModify['id']; ?>">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" value="<?php echo htmlspecialchars($userToModify['name']); ?>">
                                    <span id="nameError" class="error-message"></span>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" class="form-control" value="<?php echo htmlspecialchars($userToModify['email']); ?>">
                                    <span id="emailError" class="error-message"></span>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" value="<?php echo htmlspecialchars($userToModify['password']); ?>">
                                    <span id="passwordError" class="error-message"></span>
                                </div>
                                <button type="submit" name="update" class="btn btn-primary">Update</button>
                            </form>
                        <?php else: ?>
                            <p>User not found.</p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Validation -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('modifyUserForm');
            const nameField = document.getElementById('name');
            const emailField = document.getElementById('email');
            const passwordField = document.getElementById('password');
            const nameError = document.getElementById('nameError');
            const emailError = document.getElementById('emailError');
            const passwordError = document.getElementById('passwordError');

            form?.addEventListener('submit', function (event) {
                // Clear errors
                nameError.textContent = '';
                emailError.textContent = '';
                passwordError.textContent = '';

                const name = nameField.value.trim();
                const email = emailField.value.trim();
                const password = passwordField.value.trim();

                let isValid = true;

                // Name validation
                if (name === '') {
                    isValid = false;
                    nameError.textContent = 'Name cannot be empty.';
                }
                else if(name.length <3)
                {isValid = false;
                nameError.textContent = 'name should be minimum 3 length';}

                // Email validation
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (email === '') {
                    isValid = false;
                    emailError.textContent = 'Email cannot be empty.';
                } else if (!emailRegex.test(email)) {
                    isValid = false;
                    emailError.textContent = 'Invalid email format.';
                }

                // Password validation
                if (password === '') {
                    isValid = false;
                    passwordError.textContent = 'Password cannot be empty.';
                }
                else if(password.length<8)
                { isValid = false;
                    passwordError.textContent = 'Password should be minimum 8 length.';}

                if (!isValid) {
                    event.preventDefault();
                }
            });
        });
    </script>
</body>
</html>
