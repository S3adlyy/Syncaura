<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        button {
            background: linear-gradient(135deg, #0066ff, #33ccff); 
            color: #fff; 
            border: none;
            border-radius: 25px; 
            padding: 10px 20px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); 
            outline: none;
        }
    
        button:hover {
            background: linear-gradient(135deg, #33ccff, #0066ff); 
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4); 
        }

        button:active {
            transform: scale(0.98);
        }

        .error-messages {
            background-color: white;
            color: red;
            margin-top: 10px;
            padding: 5px;
            font-size: 0.9rem;
            display: none; /* Hide error messages initially */
        }

        .error-messages p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="spline-viewer">
    <spline-viewer url="https://prod.spline.design/O4wdVneKYyKKbJbX/scene.splinecode"></spline-viewer>
    </div>
    <div class="container">
        <form id="signin-form" action="../../../controller/loginController.php" method="post" autocomplete="on" onsubmit="return validateForm(event)">
            <h1>Login Form</h1>
            <!-- Username Input -->
            <input type="text" placeholder="Enter your username" name="username" id="username" autocomplete="username" >
            <div id="username-error" class="error-messages"></div>

            <!-- Password Input -->
            <input type="password" placeholder="Enter your password" name="pass" id="pass" autocomplete="current-password" >
            <div id="password-error" class="error-messages"></div>

            <button type="submit">Login</button>
            <div id="error-messages2" class="error-messages" style="display: block;">
            <?php if (isset($_GET['error'])): ?>
                <?php
                $error_message = '';
                if ($_GET['error'] == 1) {
                    $error_message = 'forgot your password?. <a href="reset-password.php">click here.</a>';
                }
                echo "<p>{$error_message}</p>";

                ?>

                <?php endif; ?>

</div>
            <p>Not a member? <a href="signup.php">Sign Up</a></p>
            <!-- PHP error messages (if any) will be displayed here -->
            <div id="error-messages" class="error-messages" style="display: block;">
                <?php if (isset($_GET['error'])): ?>
                    <?php
                        $error_message = '';
                        if ($_GET['error'] == 1) {
                            $error_message = "Invalid password.";
                        } elseif ($_GET['error'] == 2) {
                            $error_message = "User not found.";
                        } elseif ($_GET['error'] == 3) {
                            $error_message = 'Your account is inactive. <a href="contact/loding2.php">Please contact support.</a>';
                        }
                        elseif ($_GET['error'] == 5) {
                            $error_message = '"No account found with that email address."';
                        }
                        elseif ($_GET['error'] == 6) {
                            $error_message = "Failed to send password reset email.";
                        }
                        echo "<p>{$error_message}</p>";
                    ?>
                <?php endif; ?>
                </div>

           

        </form>
    </div>

    <script>
    // Form validation function
    function validateForm(event) {
        // Clear previous error messages
        const usernameErrorDiv = document.getElementById('username-error');
        const passwordErrorDiv = document.getElementById('password-error');
        usernameErrorDiv.innerHTML = '';
        passwordErrorDiv.innerHTML = '';
        usernameErrorDiv.style.display = 'none';
        passwordErrorDiv.style.display = 'none';

        let errors = false;

        // Get values from form inputs
        const username = document.getElementById('username').value.trim();
        const password = document.getElementById('pass').value.trim();

        // Validate username
        if (username === '') {
            errors = true;
            usernameErrorDiv.innerHTML = 'Username is required.';
            usernameErrorDiv.style.display = 'block';
        } else if (username.length < 3) {
            errors = true;
            usernameErrorDiv.innerHTML = 'Username must be at least 3 characters long.';
            usernameErrorDiv.style.display = 'block';
        }

        // Validate password
        if (password === '') {
            errors = true;
            passwordErrorDiv.innerHTML = 'Password is required.';
            passwordErrorDiv.style.display = 'block';
        } else if (password.length < 8) {
            errors = true;
            passwordErrorDiv.innerHTML = 'Password must be at least 8 characters long.';
            passwordErrorDiv.style.display = 'block';
        }

        // If there are validation errors, prevent form submission
        if (errors) {
            event.preventDefault(); // Prevent form submission
            return false;
        }

        // If no errors, allow form submission
        return true;
    }

    // Show PHP error messages on page load if any
    window.onload = function() {
        const errorMessagesDiv = document.getElementById('error-messages');
        if (errorMessagesDiv.innerHTML.trim() !== '') {
            errorMessagesDiv.style.display = 'block';  // Show the error div if there is an error message
        }
    }
</script>

    <script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.35/build/spline-viewer.js"></script>
    <script>
        window.onload = function() {
            const shadowRoot = document.querySelector('spline-viewer').shadowRoot;
            if (shadowRoot) {
                const logo = shadowRoot.querySelector('#logo');
                if (logo) logo.remove();
            }
        }
    </script>

</body>
</html>


