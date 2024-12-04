<?php
// Correct database configuration
$db = "mysql:host=localhost;dbname=chatroom_db"; // Make sure 'messages' exists in your MySQL database
$user = "root";  // Your MySQL username (default is 'root' in XAMPP)
$password = "";  // Your MySQL password (default is empty in XAMPP)

try {
    $connect = new PDO($db, $user, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
