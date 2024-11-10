<?php
include_once 'config.php'; // Ensure your database connection is included

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["send"])) {
    $name = $_POST["name"];
    $password = $_POST["pass"];

    try {
        // Prepare the SQL statement to select the password for the provided name
        $stmt = $connect->prepare("SELECT passwor FROM sync WHERE name = :name");
        $stmt->bindParam(":name", $name);
        $stmt->execute();

        // Fetch the user data
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Verify the password against the hashed password in the database
            if (password_verify($password, $user['passwor'])) {
                // Password is correct, proceed to the main page
                header("Location: main.php"); // Replace with your main page
                exit();
            } else {
                echo 'Incorrect password';
            }
        } else {
            echo 'User not found';
        }

    } catch (PDOException $e) {
        echo 'Problem: ' . $e->getMessage();
    }
}
?>
