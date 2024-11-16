<?php
$dsn = "mysql:host=localhost;dbname=dash";
$user = "root";
$password = ""; // use correct password here
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["send"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $Password =$_POST["password"]; // Hashing password

    try {
        // Create a new PDO instance
        $connect = new PDO($dsn, $user, $password);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the SQL statement
        $stmt = $connect->prepare("INSERT INTO dash (name, email, password) VALUES (:name, :email, :password)");
        
        // Bind parameters to the statement
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $Password); // Updated to match the SQL statement
        
        // Execute the prepared statement
        $stmt->execute();

        header("location:login.php");
        exit();
        
    } catch (PDOException $e) {
        // Log error or handle it accordingly
        echo 'Problem: ' . $e->getMessage();
    }
}
?>
