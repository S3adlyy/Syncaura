<?php
// Start the session to check for error messages
session_start();

// Check if there is an error flag in the URL (when login fails)
$error_message = isset($_GET['error']) ? "Invalid username or password. Please try again." : "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="art.css"> <!-- Link to your CSS file -->
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .login-container {
            background-color: #f4f4f4;
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }

        .btn {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            width: 100%;
            font-size: 1rem;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        a {
            color: #007BFF;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Login</h2>

        <!-- Display error message if login fails -->
        <?php if ($error_message): ?>
            <div class="error">
                <?= htmlspecialchars($error_message) ?>
            </div>
        <?php endif; ?>

        <form id="loginForm" action="loading.php" method="post">
            <div class="input-group">
                <label for="name">Username</label>
                <input type="text" id="name" name="name">
                <span id="usernameError" class="error"></span> <!-- Error message for username -->
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
                <span id="passwordError" class="error"></span> <!-- Error message for password -->
            </div>
            <button type="submit" class="btn">Login</button>
            <a href="registre.php" style="color: #007BFF; margin-top: 10px; display: block;">Create an account</a>
        </form>
    </div>

    <script>
        //  form validation
        document.getElementById("loginForm").addEventListener("submit", function(event) {
            // Clear error messages
            document.getElementById("usernameError").textContent = "";
            document.getElementById("passwordError").textContent = "";

            // Get form values
            const username = document.getElementById("name").value.trim();
            const password = document.getElementById("password").value.trim();

            let isValid = true;

            // Validate Username
            if (!username) {
                document.getElementById("usernameError").textContent = "Username is required.";
                isValid = false;
            } else if (username.length < 3) {
                document.getElementById("usernameError").textContent = "Username must be at least 3 characters.";
                isValid = false;
            }

            // Validate Password
            if (!password) {
                document.getElementById("passwordError").textContent = "Password is required.";
                isValid = false;
            } else if (password.length < 8) {
                document.getElementById("passwordError").textContent = "Password must be at least 8 characters.";
                isValid = false;
            }

            // If validation fails, prevent form submission
            if (!isValid) {
                event.preventDefault(); // Prevent form from submitting
            }
        });
    </script>
</body>

</html>
