<?php
// Start the session
session_start();

// Database connection details
$dsn = "mysql:host=localhost;dbname=users"; 
$user = "root"; 
$password = "";  

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["name"];
    $password_input = $_POST["password"];

    try {
        // Create a new PDO instance
        $connect = new PDO($dsn, $user, $password);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Check if the user exists in the database
        $stmt = $connect->prepare("SELECT id, name, password FROM users WHERE name = :name");
        $stmt->bindParam(":name", $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the user exists and if the password matches
        if ($user && $password_input === $user["password"]) { 
          
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["name"];
            header("Location: ../../view/home/main.php"); // Redirect to the dashboard
            exit();
        } else {
            // Invalid username or password
            header("Location: login.php?error=1");
            exit();
        }
    } catch (PDOException $e) {
        // If there is a database error
        echo "Error: " . $e->getMessage();
    }
}
?>
