<?php
// Database connection details
$db = "mysql:host=localhost;dbname=todo";
$user = "root";
$password = '';

try {
    // Create a new PDO instance
    $connect = new PDO($db, $user, $password);
    
    // Set PDO error mode to exception
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Connection successful
    echo 'Welcome to the TODO database';
} catch (PDOException $e) {
    // Catch and display the error message
    echo 'Connection failed: ' . $e->getMessage();
}
?>
