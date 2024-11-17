<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="art.css"> <!-- Link to your existing CSS file -->
    <title>Login Form</title>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>

        <!-- Error message section (hidden by default) -->
        <div id="errorMessage" style="color: red; margin-bottom: 10px; display: none;">
            Invalid username or password. Please try again.
        </div>

        <form id="loginForm" action="loading.php" method="POST">
            <div class="input-group">
                <label for="name">Username</label>
                <input type="text" id="name" name="name">
                <span id="nameError" style="color: red;"></span> <!-- Error message for name -->
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
                <span id="passwordError" style="color: red;"></span> <!-- Error message for password -->
            </div>
            <button type="submit" class="btn blue">Login</button> <!-- Submit button to login -->
            <a href="registre.php" style="color:white; margin-right:30px;">Create account</a>
        </form>
    </div>

    <script>
        // jss
        document.getElementById("loginForm").addEventListener("submit", function(event) {
            // Clear previous error messages
            document.getElementById("nameError").textContent = "";
            document.getElementById("passwordError").textContent = "";
            document.getElementById("errorMessage").style.display = "none";

       
            const username = document.getElementById("name").value.trim();
            const password = document.getElementById("password").value.trim();

            let isValid = true;

            // Check if username and password fields are required and filled
            if (!username) {
                document.getElementById("nameError").textContent = "Username is required.";
                isValid = false;
            }

            if (!password) {
                document.getElementById("passwordError").textContent = "Password is required.";
                isValid = false;
            }

            // Validate Username (min length)
            if (username && username.length < 3) {
                document.getElementById("nameError").textContent = "Username must be at least 3 characters long.";
                isValid = false;
            }

            // Validate Password (min length)
            if (password && password.length < 8) {
                document.getElementById("passwordError").textContent = "Password must be at least 8 characters long.";
                isValid = false;
            }

            // If validation fails, prevent form submission
            if (!isValid) {
                event.preventDefault(); // Prevent form from submitting
                return;
            }

        });
    </script>
</body>
</html>
