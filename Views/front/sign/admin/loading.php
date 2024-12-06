<?php
// Start the session
session_start();

// Database connection details
$dsn = "mysql:host=localhost;dbname=users"; // Replace 'users' with your database name
$user = "root"; // Default user for XAMPP
$password = "";  // Default password for XAMPP (empty string)

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["name"];
    $password_input = $_POST["pass"];

    try {
        // Create a new PDO instance
        $connect = new PDO($dsn, $user, $password);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Check if the user exists in the database
        $stmt = $connect->prepare("SELECT id, name, password, status FROM client WHERE name = :name");
        $stmt->bindParam(":name", $username);  // Bind the username parameter
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // If the user doesn't exist, show an error
        if (!$user) {
            header("Location: signin.php?error=2"); // User not found
            exit();
        }

        // Check if the user's status is active (status = 1)
        if ($user["role"] == 1) {
            header("Location: signin.php?error=3"); 
            exit();
        }

        // Check if the password matches using password_verify for hashed passwords
        if (password_verify($password_input, $user["password"])) { 
            // Password matches, set session variables
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["name"];
            header("Location: ../../loading_screen/loading_dash.html"); // Redirect to the dashboard
            exit();
        } else {
            // Invalid password
            header("Location: signin.php?error=1"); // Invalid password
            exit();
        }
    } catch (PDOException $e) {
        // If there is a database error
        echo "Error: " . $e->getMessage();
    }
}
?>
