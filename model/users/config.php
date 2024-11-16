<?php
// Database connection details
$dsn = "mysql:host=localhost;dbname=users";
$user = "root";
$password = ""; // Use the correct password for your MySQL user

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["send"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $Password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hashing the password securely

    try {
        // Create a new PDO instance
        $connect = new PDO($dsn, $user, $password);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the SQL statement to insert data
        $stmt = $connect->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");

        // Bind parameters to the statement
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $Password); // Store the hashed password

        // Execute the prepared statement
        $stmt->execute();

        // Redirect to login page
        header("location:login.php");
        exit();

    } catch (PDOException $e) {
        // Log the error or handle it accordingly
        echo 'Problem: ' . $e->getMessage();
    }
}
?>
