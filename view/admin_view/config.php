<?php
// Database connection details
$dsn = "mysql:host=localhost;dbname=users";  // Replace with your database name
$db_user = "root";  // Your database username
$db_password = "";  // Your database password

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = trim($_POST['namex']);
    $surname = trim($_POST['surname']);
    $username = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['pass']);

    try {
        // Input validation (make sure all fields are filled)
        if (empty($name) || empty($surname) || empty($username) || empty($email) || empty($password)) {
            header("Location: signup.php?error=" . urlencode("All fields are required."));
            exit();
        }

        // Connect to the database
        $connect = new PDO($dsn, $db_user, $db_password);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Check if the email already exists in the database
        $stmt = $connect->prepare("SELECT * FROM client WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // If email exists, redirect back with error
            header("Location: signup.php?error=2");
            exit();
        }

        // Check if the username already exists in the database
        $stmt = $connect->prepare("SELECT * FROM client WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // If username exists, redirect back with error
            header("Location: signup.php?error=2");
            exit();
        }

        // Hash the password before storing
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Insert user into the database
        $stmt = $connect->prepare("INSERT INTO client (name, surname, username, email, password, status, role ) VALUES (:name, :surname, :username, :email, :password, 1, 1)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':surname', $surname);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->execute();

        // Redirect to login page after successful registration
        header("Location: signin.php?success=1");
        exit();
    } catch (PDOException $e) {
        // Handle any database errors
        echo "Error: " . $e->getMessage();
    }
}
?>
