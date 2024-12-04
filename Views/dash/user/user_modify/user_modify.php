<?php
session_start();

// Database connection details
$dsn = "mysql:host=localhost;dbname=users";
$db_user = "root";
$db_password = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $new_username = $_POST["username"];
    $current_password = $_POST["current_password"];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];
    $user_id = $_SESSION["user_id"]; // Assume the user is logged in

    // Check if the new passwords match
    if ($new_password !== $confirm_password) {
        echo "Passwords do not match!";
        exit;
    }

    try {
        $pdo = new PDO($dsn, $db_user, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Fetch the current user's details
        $stmt = $pdo->prepare("SELECT password FROM client WHERE id = :id");
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify the current password
        if (!$user || !password_verify($current_password, $user["password"])) {
            echo "Invalid current password!";
            exit;
        }

        // Update username and password
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
        $update_stmt = $pdo->prepare("UPDATE client SET username = :name, password = :password WHERE id = :id");
        $update_stmt->bindParam(':name', $new_username, PDO::PARAM_STR);
        $update_stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
        $update_stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $update_stmt->execute();

        // Redirect to the dashboard
        header("Location: ../user_modify/main.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
