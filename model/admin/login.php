<?php
// Start the session to check for error messages
session_start();

// Check if there is an error flag in the URL (when login fails)
$error_message = isset($_GET['error']) ? "Invalid username or password. Please try again." : "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="art.css"> <!-- Link to your CSS file -->
    <title>Login Form</title>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>

        <!-- Display error message if login fails -->
        <?php if ($error_message): ?>
            <div class="error" style="color: red; margin-bottom: 10px;">
                <?= htmlspecialchars($error_message) ?>
            </div>
        <?php endif; ?>

        <form action="loading.php" method="post"> <!-- Direct action to loading.php -->
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn blue">Login</button> <!-- Submit button to login -->
            <a href="registre.php" style="color:white; margin-right:30px;">Create account</a>
        </form>
    </div>
</body>
</html>
