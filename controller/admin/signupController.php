<?php
// Start the session for possible error messages or success messages
session_start();

// Include the model file for database interaction
include_once '../../model/admin/adminmodel.php';  // Ensure the path is correct if it's in a different folder

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $name = trim($_POST['namex']);
    $surname = trim($_POST['surname']);
    $username = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['pass']);

    // Input validation (check if all fields are filled)
    if (empty($name) || empty($surname) || empty($username) || empty($email) || empty($password)) {
        header("Location: ../ ../view/admin_view/signup.php?error=" . urlencode("All fields are required."));
        exit();
    }

    // Check if email already exists in the database
    if (checkEmailExists($email)) {
        header("Location: ../ ../view/admin_view/signup.php?error=2");  // Email already exists
        exit();
    }

    // Check if username already exists in the database
    if (checkUsernameExists($username)) {
        header("Location: ../ ../view/admin_view/signup.php?error=3");  // Username already exists
        exit();
    }

    try {
        // Register the new user
        registerUser($name, $surname, $username, $email, $password);

        // Redirect to login page after successful registration
        header("Location:../ ../view/admin_view/signin.php?success=1");
        exit();
    } catch (PDOException $e) {
        // Handle any database errors
        echo "Error: " . $e->getMessage();
    }
}
?>
