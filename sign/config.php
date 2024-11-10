<?php
$dsn = "mysql:host=localhost;dbname=4";
$user = "root";
$password = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["send"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $hashedPassword = password_hash($_POST["pass"], PASSWORD_DEFAULT);

    try {
        $connect = new PDO($dsn, $user, $password);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $connect->prepare("INSERT INTO sync (name, email, passwor) VALUES (:name, :email, :passwor)");
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":passwor", $hashedPassword);
        $stmt->execute();
        header("Location: signin.php");
        exit(); 
        
    } catch (PDOException $e) {
        // Log error or handle it accordingly
        echo 'Problem: ' . $e->getMessage();
    }
}
?>
