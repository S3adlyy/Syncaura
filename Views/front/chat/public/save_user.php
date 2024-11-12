<?php
// save_user.php

// Database configuration
$dsn = "mysql:host=localhost;dbname=chatroom_db"; // Ensure this matches your database configuration
$db_user = "root";                                // Database username
$db_password = "";                                // Database password

try {
    // Create a PDO instance
    $pdo = new PDO($dsn, $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get the username from the POST request
    $username = $_POST['username'];

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $pdo->prepare("INSERT INTO users (username) VALUES (:username)");
    $stmt->bindParam(':username', $username);

    // Execute the statement
    $stmt->execute();

    echo "User saved successfully";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
