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
        // Input validation
        if (empty($name) || empty($surname) || empty($username) || empty($email) || empty($password)) {
            header("Location: signup.php?error=" . urlencode("All fields are required."));
            exit();
        }

        // Validate name and surname (must contain only letters)
        if (!preg_match("/^[A-Za-z]+$/", $name)) {
            header("Location: sign.php?error=" . urlencode("Name must contain only letters."));
            exit();
        }

        if (!preg_match("/^[A-Za-z]+$/", $surname)) {
            header("Location: signup.php?error=" . urlencode("Surname must contain only letters."));
            exit();
        }

        // Validate username: at least 3 letters
        $letterCount = preg_replace("/[^a-zA-Z]/", '', $username); // Remove non-letter characters
        if (strlen($letterCount) < 3) {
            header("Location: signup.php?error=" . urlencode("Username must contain at least 3 letters."));
            exit();
        }

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: signup.php?error=" . urlencode("Invalid email format."));
            exit();
        }

        // Validate password: at least 6 characters
        if (strlen($password) < 6) {
            header("Location: signup.php?error=" . urlencode("Password must be at least 6 characters long."));
            exit();
        }

        // Hash the password before storing
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Connect to the database
        $connect = new PDO($dsn, $db_user, $db_password);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Check if the username or email already exists in the database
        $stmt = $connect->prepare("SELECT * FROM client WHERE email = :email OR username = :username");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            header("Location: signup.php?error=" . urlencode("Username or email already exists."));
            exit();
        }

        // Insert user into the database
        $stmt = $connect->prepare("INSERT INTO client (name, surname, username, email, password) VALUES (:name, :surname, :username, :email, :password)");
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
