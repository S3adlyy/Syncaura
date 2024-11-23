<?php
include_once '../../models/chat_db/config.php';

if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];

    // Fetch the user's current username
    $stmt = $connect->prepare("SELECT username FROM users WHERE id = :id");
    $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle form submission to update username
            $newUsername = $_POST['username'];

            $updateStmt = $connect->prepare("UPDATE users SET username = :username WHERE id = :id");
            $updateStmt->bindParam(':username', $newUsername);
            $updateStmt->bindParam(':id', $userId, PDO::PARAM_INT);

            if ($updateStmt->execute()) {
                echo "Username updated successfully!";
                header("Location: ../../Views/dash/Table_Chatuser.php"); // Redirect to the users table page
                exit;
            } else {
                echo "Error updating username.";
            }
        }
    } else {
        echo "User not found.";
    }
} else {
    echo "No user ID provided.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Username</title>
</head>
<body>
    <form method="POST">
        <label for="username">New Username:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        <button type="submit">Update Username</button>
    </form>
</body>
</html>
