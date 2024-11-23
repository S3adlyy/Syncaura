<?php
// Database connection details
$dsn = "mysql:host=localhost;dbname=users";  // Replace with your database name
$db_user = "root";  // Your database username
$db_password = "";  // Your database password

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Create a PDO instance
try {
    $db = new PDO($dsn, $db_user, $db_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Include the UserModel class
include_once '../../model/usersign/UserModel.php';

// Instantiate the UserModel
$userModel = new UserModel($db);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = trim($_POST['namex']);
    $surname = trim($_POST['surname']);
    $username = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['pass']);

    // Validate form data
    if (empty($name) || empty($surname) || empty($username) || empty($email) || empty($password)) {
        header("Location: ../../view/user_view/signup.php?error=" . urlencode("All fields are required."));
        exit();
    }

    // Check if the email already exists
    if ($userModel->emailExists($email)) {
        header("Location: ../../view/user_view/signup.php?error=2");
        exit();
    }

    // Check if the username already exists
    if ($userModel->usernameExists($username)) {
        header("Location: ../../view/user_view/signup.php?error=2");
        exit();
    }

    // Create a new user
    try {
        $userModel->createUser($name, $surname, $username, $email, $password);

        // Redirect to the login page after successful registration
        header("Location: ../../view/user_view/signin.php?success=1");
        exit();
    } catch (Exception $e) {
        // Handle any errors during user creation
        echo "Error: " . $e->getMessage();
    }
}
?>
