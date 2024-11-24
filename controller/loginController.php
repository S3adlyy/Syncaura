<?php
// Start the session
session_start();

// Include the model file for database interaction
include_once '../model/usersign/model.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form inputs
    $username = $_POST["name"];
    $password_input = $_POST["pass"];

    // Try to authenticate the user
    $user = authenticateUser($username, $password_input);

    if ($user) {
        // Check if the user's status is active (status = 1)
        if ($user["status"] == 0) {
            header("Location: ../view/user_view/signin.php?error=3"); // Account is inactive
            exit();
        }

        // Set session variables for the authenticated user
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["name"];

        // Redirect to the user dashboard (main.php or wherever you want)
        header("Location:../view/user_view/user_dash/main.php");
        exit();
    } else {
        // Invalid credentials or user not found
        header("Location: ../view/user_view/signin.php?error=1"); // Invalid credentials
        exit();
    }
}
?>
