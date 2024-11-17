<?php
// Database connection details
$dsn = "mysql:host=localhost;dbname=users"; 
$db_user = "root"; 
$db_password = "";

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['send'])) {
    // Retrieve form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']); 

    try {
        // Input validation 
        if (empty($name) || empty($email) || empty($password)) {
            header("Location: registre.php?error=" . urlencode("All fields are required."));
            exit();
        }

        if (strlen($name) < 3) {
            header("Location: registre.php?error=" . urlencode("Name must be at least 3 characters long."));
            exit();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: registre.php?error=" . urlencode("Invalid email format."));
            exit();
        }

        if (strlen($password) < 8) {
            header("Location: registre.php?error=" . urlencode("Password must be at least 8 characters long."));
            exit();
        }

        // Connect to the database
        $connect = new PDO($dsn, $db_user, $db_password);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insert user into the database
        $stmt = $connect->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        // Redirect to the login page with a success message
        header("Location: login.php?success=1");
        exit();
    } catch (PDOException $e) {
        // Handle database errors
        header("Location: registre.php?error=" . urlencode("Error: " . $e->getMessage()));
        exit();
    }
}
?>
