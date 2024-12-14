<?php
// reset-password.php
// Display the form to reset the password if a valid token is provided

// Include database connection
$dsn = "mysql:host=localhost;dbname=users"; // Replace with your database name
$db_user = "root"; // Your database username
$db_password = ""; // Your database password

try {
    $pdo = new PDO($dsn, $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Check if token is provided
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Validate token in the database
    $stmt = $pdo->prepare("SELECT email, expires FROM password_resets WHERE token = ?");
    $stmt->execute([$token]);
    $resetData = $stmt->fetch();

    if ($resetData) {
        // Check if the token has expired
        if (time() > $resetData['expires']) {
            echo "This password reset link has expired.";
            exit;
        }
    } else {
        echo "Invalid or expired token.";
        exit;
    }
} else {
    echo "No token provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<div class="spline-viewer">
<spline-viewer url="https://prod.spline.design/O4wdVneKYyKKbJbX/scene.splinecode"></spline-viewer>
    </div>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        /* Form container */
        #Form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
        }

        /* Heading */
        h1 {
            text-align: center;
            color: #4CAF50;
            font-size: 24px;
            margin-bottom: 20px;
        }

        /* Input fields */
        input[type="text"],
        input[type="password"],
        input[type="date"],
        input[type="radio"],
        input[type="email"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        /* Placeholder styling */
        input::placeholder {
            color: #888;
        }

        /* Error messages */
        .error {
            color: red;
            font-size: 12px;
            margin-top: 4px;
            display: block;
        }

        /* Submit button styling */
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Error messages in a specific container */
        #php-error-messages {
            display: none;
            margin-top: 10px;
            padding: 8px;
            background-color: #ffdddd;
            border: 1px solid #ff4444;
            border-radius: 5px;
            color: red;
        }
    </style>
            <link rel="stylesheet" href="styles.css">

</head>
<body>
<div id="Form">
    <h1>Reset Your Password</h1>
    <form id="resetPasswordForm" action="reset-procus.php" method="post" onsubmit="return validateForm(event)">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

        <!-- Error messages for PHP -->
        <div id="php-error-messages">
            <!-- PHP errors can be dynamically inserted here -->
        </div>

        <label for="new_password">New Password:</label>
        <input type="password" name="new_password" id="new_password" placeholder="Enter new password">
        <div id="password-error" class="error"></div>

        <label for="confirm_password">Confirm New Password:</label>
        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm new password">
        <div id="password-error2" class="error"></div>

        <button type="submit">Reset Password</button>
    </form>
</div>

<script>
    // Form validation function
    function validateForm(event) {
        // Clear previous error messages
        const passwordErrorDiv = document.getElementById('password-error');
        const passwordError2Div = document.getElementById('password-error2');
        passwordErrorDiv.innerHTML = '';
        passwordError2Div.innerHTML = '';
        passwordErrorDiv.style.display = 'none';
        passwordError2Div.style.display = 'none';

        let errors = false;

        // Get values from form inputs
        const password = document.getElementById('new_password').value.trim();
        const passwordconf = document.getElementById('confirm_password').value.trim();

        // Validate password
        if (password === '') {
            errors = true;
            passwordErrorDiv.innerHTML = 'Password is required.';
            passwordErrorDiv.style.display = 'block';
        } else if (password.length < 8) {
            errors = true;
            passwordErrorDiv.innerHTML = 'Password must be at least 68 characters long.';
            passwordErrorDiv.style.display = 'block';
        } else if (!/\d/.test(password)) {  // Check for at least one number
            errors = true;
            passwordErrorDiv.innerHTML = 'Password must contain at least one number.';
            passwordErrorDiv.style.display = 'block';
        } else if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) {  // Check for at least one symbol
            errors = true;
            passwordErrorDiv.innerHTML = 'Password must contain at least one symbol.';
            passwordErrorDiv.style.display = 'block';
        }

        // Confirm password validation
        if (passwordconf === '') {
            errors = true;
            passwordError2Div.innerHTML = 'Please confirm your password.';
            passwordError2Div.style.display = 'block';
        } else if (password !== passwordconf) {
            errors = true;
            passwordError2Div.innerHTML = 'Passwords must match.';
            passwordError2Div.style.display = 'block';
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
        const errorMessagesDiv = document.getElementById('php-error-messages');
        // Assuming PHP error messages are passed in (for example)
        const phpErrorMessages = "<?php echo isset($phpErrorMessages) ? $phpErrorMessages : ''; ?>";
        if (phpErrorMessages.trim() !== '') {
            errorMessagesDiv.style.display = 'block';  // Show the error div if there are error messages
            errorMessagesDiv.innerHTML = phpErrorMessages;
        }
    }
</script>
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
