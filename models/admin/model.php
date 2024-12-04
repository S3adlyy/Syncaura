<?php
// Database connection details
$dsn = "mysql:host=localhost;dbname=users";  // Replace 'users' with your database name
$user = "root";  // Default user for XAMPP
$password = "";  // Default password for XAMPP (empty string)

// Create a new PDO instance for database connection
try {
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Function to authenticate the user
function authenticateUser($username, $password_input) {
    global $db;  // Use the global database connection

    // Check if the user exists in the database
    $stmt = $db->prepare("SELECT id, username, password, status, role FROM client WHERE username = :username");
    $stmt->bindParam(":username", $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // If the user exists, check if the password matches
        if (password_verify($password_input, $user["password"])) {
            // Return the user data if password is correct
            return $user;
        }
    }

    return false;  // Return false if user not found or password incorrect
}
?>
