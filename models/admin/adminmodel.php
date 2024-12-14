<?php
// Database connection details
$dsn = "mysql:host=localhost;dbname=users";  // Replace with your database name
$db_user = "root";  // Your database username
$db_password = "";  // Your database password

// Create a new PDO instance for database connection
try {
    $connect = new PDO($dsn, $db_user, $db_password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Function to check if email already exists
function checkEmailExists($email) {
    global $connect;
    $stmt = $connect->prepare("SELECT * FROM client WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    return $stmt->rowCount() > 0;  // Return true if email exists
}

// Function to check if username already exists
function checkUsernameExists($username) {
    global $connect;
    $stmt = $connect->prepare("SELECT * FROM client WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    return $stmt->rowCount() > 0;  // Return true if username exists
}

// Function to register a new user
function registerUser($name, $surname, $username, $email, $password) {
    global $connect;
    
    // Hash the password before storing
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert user into the database
    $stmt = $connect->prepare("INSERT INTO client (name, surname, username, email, password, status, role) VALUES (:name, :surname, :username, :email, :password, 1, 1)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':surname', $surname);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->execute();
}
?>
