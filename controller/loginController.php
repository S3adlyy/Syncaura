<?php
// Start the session
session_start();

// Include the model file for database interaction
include_once '../models/usersign/model.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form inputs
    $username = $_POST["username"];
    $password_input = $_POST["pass"];

    // Try to authenticate the user
    $user = authenticateUser($username, $password_input);

    if ($user) {
        // Check if the user's status is active (status = 1)
        if ($user["status"] == 0) {
            header("Location: ../Views/front/sign/signin.php?error=3"); // Account is inactive
            exit();
        }

        // Set session variables for the authenticated user
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["profile_picture"] = $user["profile_picture"]; // Ensure profile picture is saved

        // Redirect to the user dashboard (main.php or wherever you want)
        header("Location: ../Views/front/loading_screen/loading_main.html");
        exit();
    } else {
        // Invalid credentials or user not found
        header("Location: ../Views/front/sign/signin.php?error=1"); // Invalid credentials
        exit();
    }
}
?>
