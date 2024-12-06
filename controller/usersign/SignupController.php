<?php
// Database connection details
$dsn = "mysql:host=localhost;dbname=users";  // Replace with your database name
$db_user = "root";  // Your database username
$db_password = "";  // Your database password

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include the UserModel class
include_once '../../models/usersign/UserModel.php';

// Create a PDO instance
try {
    $db = new PDO($dsn, $db_user, $db_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Instantiate the UserModel
$userModel = new UserModel($db);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate form data manually
    $name = htmlspecialchars(strip_tags(trim($_POST['namex'])));
    $surname = htmlspecialchars(strip_tags(trim($_POST['surname'])));
    $username = htmlspecialchars(strip_tags(trim($_POST['name'])));
    $email = trim($_POST['email']);
    $password = trim($_POST['pass']);
    $phone = htmlspecialchars(strip_tags(trim($_POST['phone'])));
    $gender = isset($_POST['gender']) ? $_POST['gender'] : null;  // Get gender from form
    $birthdate = trim($_POST['birthdate']);
    $profilePicturePath = null;

    // Convert gender to 0 or 1 for male/female
    if ($gender === 'Male') {
        $gender = '0'; // Male = 0
    } elseif ($gender === 'Female') {
        $gender = '1'; // Female = 1
    }

    // Validate required fields
    if (
        empty($name) || empty($surname) || empty($username) || !filter_var($email, FILTER_VALIDATE_EMAIL) ||
        empty($password) || empty($phone) || is_null($gender) || empty($birthdate)
    ) {
        header("Location: ../../Views/front/sign/signup.php?error=1&message=Missing required fields");
        exit();
    }

    // Profile picture upload handling
    if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] == UPLOAD_ERR_OK) {
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $uploadDir = '../../uploads/profile_pictures/';
        $fileInfo = pathinfo($_FILES['profilePicture']['name']);
        $fileExtension = strtolower($fileInfo['extension']);
        $mimeType = mime_content_type($_FILES['profilePicture']['tmp_name']);

        if (in_array($fileExtension, $allowedExtensions) && strpos($mimeType, 'image/') === 0) {
            // Ensure upload directory exists
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $newFileName = uniqid('profile_', true) . '.' . $fileExtension;
            $profilePicturePath = $uploadDir . $newFileName;

            if (!move_uploaded_file($_FILES['profilePicture']['tmp_name'], $profilePicturePath)) {
                header("Location: ../../Views/front/sign/signup.php?error=4&message=Profile picture upload failed");
                exit();
            }
        } else {
            header("Location: ../../Views/front/sign/signup.php?error=3&message=Invalid profile picture format");
            exit();
        }
    }

    // Check if the email or username already exists
    if ($userModel->emailExists($email) || $userModel->usernameExists($username)) {
        header("Location: ../../Views/front/sign/signup.php?error=2&message=Username or email already exists");
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Create a new user
    try {
        $userModel->createUser(
            $name,
            $surname,
            $username,
            $email,
            $hashedPassword,
            $phone,
            $gender,  // Gender is now correctly set as 0 or 1
            $birthdate,
            $profilePicturePath
        );

        // Redirect to the login page after successful registration
        header("Location: ../../Views/front/sign/signin.php?success=1");
        exit();
    } catch (Exception $e) {
        // Handle any errors during user creation
        error_log("Error creating user: " . $e->getMessage());  // Log the error for debugging
        header("Location: ../../Views/front/sign/signup.php?error=5&message=Internal server error");
        exit();
    }
}
?>
