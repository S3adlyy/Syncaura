<?php
session_start();

// Database connection details
$dsn = "mysql:host=localhost;dbname=users";
$db_user = "root";
$db_password = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $new_username = trim($_POST["username"]);
    $current_password = $_POST["current_password"];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];
    $user_id = $_SESSION["user_id"] ?? null;

    if (!$user_id) {
        echo "You must be logged in to perform this action.";
        exit;
    }

    // Check if passwords match (if a new password is provided)
    if (!empty($new_password) && $new_password !== $confirm_password) {
        echo "Passwords do not match!";
        exit;
    }

    try {
        // Establish a database connection
        $pdo = new PDO($dsn, $db_user, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Fetch the current user's details
        $stmt = $pdo->prepare("SELECT password FROM client WHERE id = :id");
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify the current password
        if (!$user || !password_verify($current_password, $user["password"])) {
            header("Location: ../user_dash/main.php?error=1");
        exit();
            exit;
        }

        // Build the update query dynamically
        $update_query = "UPDATE client SET ";
        $update_fields = [];
        $params = [':id' => $user_id];

        // Update username if provided
        if (!empty($new_username)) {
            $update_fields[] = "username = :name";
            $params[':name'] = $new_username;
        }

        // Update password if provided
        if (!empty($new_password)) {
            $update_fields[] = "password = :password";
            $params[':password'] = password_hash($new_password, PASSWORD_BCRYPT);
        }

        // Handle profile picture upload if provided
        if (isset($_FILES["profile_picture"]) && $_FILES["profile_picture"]["error"] === UPLOAD_ERR_OK) {
            $upload_dir = "../../../uploads/profile_pictures/"; // Corrected directory path
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true); // Create the directory if it doesn't exist
            }

            $file_tmp = $_FILES["profile_picture"]["tmp_name"];
            $file_name = basename($_FILES["profile_picture"]["name"]);
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            // Allow only specific file types
            if (in_array($file_ext, ["jpg", "jpeg", "png", "gif"])) {
                $new_file_name = $user_id . "_profile." . $file_ext;
                $file_path = $upload_dir . $new_file_name;

                // Move the uploaded file to the upload directory
                if (move_uploaded_file($file_tmp, $file_path)) {
                    $update_fields[] = "profile_picture = :profile_picture";
                    $params[':profile_picture'] = $file_path;
                } else {
                    echo "Error uploading profile picture.";
                    exit;
                }
            } else {
                echo "Invalid file type for profile picture. Only JPG, PNG, and GIF are allowed.";
                exit;
            }
        }

        // Execute the update query if there are fields to update
        if (!empty($update_fields)) {
            $update_query .= implode(", ", $update_fields) . " WHERE id = :id";
            $update_stmt = $pdo->prepare($update_query);
            $update_stmt->execute($params);

            // Update session variables
            if (!empty($new_username)) {
                $_SESSION['username'] = $new_username;
            }
            if (!empty($file_path)) {
                $_SESSION['profile_picture'] = $file_path;
            }
        }

        // Redirect to the main user profile page
        header("Location: ../user_dash/main.php");
        exit();
    } catch (PDOException $e) {
        // Log the error and show a generic message
        error_log("Database Error: " . $e->getMessage());
        echo "An error occurred. Please try again later.";
        exit();
    }
} else {
    echo "Invalid request method.";
    exit();
}
?>
