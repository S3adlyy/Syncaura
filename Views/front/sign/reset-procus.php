<?php
session_start();

// Database connection details
$dsn = "mysql:host=localhost;dbname=users";
$db_user = "root";
$db_password = "";

// Create PDO instance
try {
    $pdo = new PDO($dsn, $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $token = $_POST['token'] ?? '';

    // Validate the new password and confirm password
    if (empty($new_password) || empty($confirm_password)) {
        echo "Both password fields are required.";
        exit;
    }

    if ($new_password !== $confirm_password) {
        echo "Passwords do not match.";
        exit;
    }

    if (strlen($new_password) < 6) {
        echo "Password must be at least 6 characters long.";
        exit;
    }

    try {
        // Check if the token is valid and not expired
        $stmt = $pdo->prepare("SELECT email, expires FROM password_resets WHERE token = :token");
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);
        $stmt->execute();
        $reset_data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$reset_data) {
            echo "Invalid or expired token.";
            exit;
        }

        // Check if the token has expired
        if (time() > $reset_data['expires']) {
            echo "This reset link has expired.";
            exit;
        }

        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

        // Update the password in the `client` table
        $stmt = $pdo->prepare("UPDATE client SET password = :password WHERE email = :email");
        $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
        $stmt->bindParam(':email', $reset_data['email'], PDO::PARAM_STR);
        $stmt->execute();

        // Delete the token after successful password reset
        $stmt = $pdo->prepare("DELETE FROM password_resets WHERE token = :token");
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);
        $stmt->execute();

        echo "Your password has been successfully reset. You can now log in.";
        header("Location: ../../../Views/front/sign/signin.php?");
        exit;

    } catch (PDOException $e) {
        echo "An error occurred: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
?>