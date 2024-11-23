<?php
// Database connection details
$dsn = "mysql:host=localhost;dbname=users"; // Change to your database name
$user = "root"; // Default user for XAMPP
$password = ""; // Default password for XAMPP (empty string)

// Create a new PDO instance for database connection
try {
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Function to check if the user exists and verify password
function authenticateUser($username, $password_input) {
    global $db;  // Use the global database connection

    $stmt = $db->prepare("SELECT id, name, password, status FROM client WHERE name = :name");
    $stmt->bindParam(":name", $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // If the user exists, verify the password
        if (password_verify($password_input, $user["password"])) {
            // If the password is correct, return user details
            return $user;
        }
    }

    return false; // Return false if user not found or password incorrect
}
?>
