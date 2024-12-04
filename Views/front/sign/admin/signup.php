<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" type="x-icon" href="img.png">
    <style>
        /* Styles for the form and error messages */
        form {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 8px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: black;
            font-size: 12px;
        }

        h1 {
            text-align: center;
        }

        p {
            text-align: center;
        }

        a {
            color: blue;
        }
    </style>
</head>
<body>
    <div class="spline-viewer">
        <spline-viewer url="https://prod.spline.design/O4wdVneKYyKKbJbX/scene.splinecode"></spline-viewer>
    </div>

    <form id="registrationForm" action="config.php" method="post">
        <h1>Signup Form</h1>

        <input type="text" placeholder="Put your name" name="namex" id="namex">
        <div id="nameError" class="error"></div>

        <input type="text" placeholder="Put your surname" name="surname" id="surname">
        <div id="surnameError" class="error"></div>

        <input type="text" placeholder="Put your username" name="name" id="name">
        <div id="usernameError" class="error"></div>

        <input type="text" placeholder="Email" name="email" id="email">
        <div id="emailError" class="error"></div>

        <input type="password" placeholder="Password" name="pass" id="pass">
        <div id="passwordError" class="error"></div>

        <input type="submit" id="send" value="Sign Up">
        

        <div id="php-error-messages" class="error-messages" <?php echo isset($_GET['error']) ? 'style="display:block;"' : 'style="display:none;"'; ?>>
    <?php if (isset($_GET['error'])): ?>
        <?php
            $error_message = '';
            if ($_GET['error'] == 2) {
                $error_message = "Username or email already exist.";
            }
            echo "<p>{$error_message}</p>";
        ?>
    <?php endif; ?>
</div>
        <p>Already a member? <a href="signin.php" style="color: blue;">Sign In</a></p>
    </form>

    <script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.35/build/spline-viewer.js"></script>

    <script>
        document.getElementById("registrationForm").addEventListener("submit", function(event) {
            // Clear previous error messages
            document.getElementById("nameError").textContent = "";
            document.getElementById("surnameError").textContent = "";
            document.getElementById("usernameError").textContent = "";
            document.getElementById("emailError").textContent = "";
            document.getElementById("passwordError").textContent = "";

            const name = document.getElementById("namex").value.trim();
            const surname = document.getElementById("surname").value.trim();
            const username = document.getElementById("name").value.trim();
            const email = document.getElementById("email").value.trim();
            const password = document.getElementById("pass").value.trim();

            let isValid = true;

            // Validate name
            const namePattern = /^[A-Za-z]+$/;
            if (!name) {
    document.getElementById("nameError").textContent = "Name is required.";
    isValid = false;
} else if (!namePattern.test(name)) {
    document.getElementById("nameError").textContent = "Name must contain only letters.";
    isValid = false;
} else if (name.length < 3) {  // Check if name is at least 3 characters long
    document.getElementById("nameError").textContent = "Name must be at least 3 characters long.";
    isValid = false;
}

// Validate surname
const surnamePattern = /^[A-Za-z]+$/;
if (!surname) {
    document.getElementById("surnameError").textContent = "Surname is required.";
    isValid = false;
} else if (!surnamePattern.test(surname)) {
    document.getElementById("surnameError").textContent = "Surname must contain only letters.";
    isValid = false;
} else if (surname.length < 3) {  // Check if surname is at least 3 characters long
    document.getElementById("surnameError").textContent = "Surname must be at least 3 characters long.";
    isValid = false;
}

            // Validate username
            if (!username) {
                document.getElementById("usernameError").textContent = "Username is required.";
                isValid = false;
            } else if (username.length < 3) {
                document.getElementById("usernameError").textContent = "Username must be at least 3 characters.";
                isValid = false;
            }

            // Validate email
            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!email) {
                document.getElementById("emailError").textContent = "Email is required.";
                isValid = false;
            } else if (!emailPattern.test(email)) {
                document.getElementById("emailError").textContent = "Please enter a valid email address.";
                isValid = false;
            }

          // Validate password
if (!password) {
    document.getElementById("passwordError").textContent = "Password is required.";
    isValid = false;
} else if (password.length < 8) {
    document.getElementById("passwordError").textContent = "Password must be at least 8 characters.";
    isValid = false;
} else if (!/[a-zA-Z]/.test(password)) {
    document.getElementById("passwordError").textContent = "Password must contain at least one letter.";
    isValid = false;
} else if (!/[0-9]/.test(password)) {
    document.getElementById("passwordError").textContent = "Password must contain at least one number.";
    isValid = false;
} else if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
    document.getElementById("passwordError").textContent = "Password must contain at least one symbol.";
    isValid = false;
}


            // Prevent form submission if validation fails
            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>

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
