<?php
$dsn = "mysql:host=localhost;dbname=chatroom_db";
$user = "root";
$password = "";

try {
    $connect = new PDO($dsn, $user, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    echo 'Problem: ' . $e->getMessage();
}
?>
