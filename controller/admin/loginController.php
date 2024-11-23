<?php
// Start the session
session_start();

// Include the model file
include_once '../../model/admin/model.php';  // Make sure model.php is in the same directory or adjust the path

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["name"];
    $password_input = $_POST["pass"];

    // Authenticate the user by calling the authenticateUser function from the model
    $user = authenticateUser($username, $password_input);

    if ($user) {
        // If the user exists and password is correct, check the status and role
        if ($user["status"] == 0) {
            // If the account is inactive, redirect to the login page with an error
            header("Location: ../../view/admin_view/signin.php?error=3");
            exit();
        }

        // Check if the user has an admin role (role = 1)
        if ($user["role"] == 1) {
            // Set session variables for the authenticated user
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["name"];

            // Redirect to the admin dashboard
            header("Location: ../../view/admin_dashboard/dash.php");
            exit();
        } else {
            // If the user is not an admin, you can either show an error or redirect elsewhere
            header("Location:../../view/admin_view/signin.php?error=4");  // You can change this logic as needed
            exit();
        }
    } else {
        // If authentication fails, redirect back with an error message
        header("Location: ../../view/admin_view/signin.php?error=1");  // Invalid password or user not found
        exit();
    }
}
?>
