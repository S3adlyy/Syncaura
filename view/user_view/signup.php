<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" type="x-icon" href="img.png">
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
#registrationForm {
    background-color: white;
    padding: 15px 25px;  /* Reduced padding */
    border-radius: 8px;  /* Smaller radius for a tighter design */
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;  /* Reduced max-width for a smaller form */
    box-sizing: border-box;
}

/* Heading */
h1 {
    text-align: center;
    color: #4CAF50;
    font-size: 20px;  /* Reduced font size */
    margin-bottom: 15px;
}

/* Input fields */
input[type="text"],
input[type="password"],
input[type="date"],
input[type="radio"],
input[type="email"] {
    width: 100%;
    padding: 12px; /* Reduced padding */
    margin: 8px 0;  /* Reduced margin */
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    font-size: 16px;  /* Reduced font size */
}

/* Placeholder styling */
input::placeholder {
    color: #888;
}

/* Label for radio buttons */
label {
    margin-right: 8px; /* Reduced spacing */
    font-size: 14px;   /* Reduced font size */
}

/* Form Group */
.form-group {
    margin-bottom: 12px; /* Reduced space between fields */
}

.form-group-horizontal {
    display: flex;
    justify-content: space-between;
    gap: 8px;  /* Reduced gap between fields */
}

.form-group-horizontal .form-group {
    width: calc(50% - 4px);  /* Reduced width for a more compact layout */
}

/* Error messages */
.error {
    color: red;
    font-size: 12px;  /* Reduced font size */
    margin-top: 4px;  /* Reduced margin */
}

/* Radio buttons container */
.radio-group {
    display: flex;
    justify-content: space-between;
    margin-bottom: 12px; /* Reduced margin */
}

/* Submit button styling */
input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 15px; /* Reduced padding */
    width: 100%;
    border-radius: 5px;
    font-size: 16px;  /* Reduced font size */
    cursor: pointer;
    margin-top: 15px;  /* Reduced margin */
    transition: background-color 0.3s;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

/* Error messages in a specific container */
#error-container {
    display: none;
    margin-top: 10px;
    padding: 8px;
    background-color: #ffdddd;
    border: 1px solid #ff4444;
    border-radius: 5px;
    color: red;
}

/* Make sure the form is well-centered and responsive */
@media (max-width: 600px) {
    .form-group-horizontal {
        flex-direction: column;
    }

    .form-group-horizontal .form-group {
        width: 100%;
    }
}
    </style>
</head>
<body>
    <div class="spline-viewer">
        <spline-viewer url="https://prod.spline.design/O4wdVneKYyKKbJbX/scene.splinecode"></spline-viewer>
    </div>

    <form id="registrationForm" action="../../controller/usersign/SignupController.php" method="post">
        <h1>Signup Form</h1>

        <!-- Name and Surname displayed horizontally -->
        <div class="form-group form-group-horizontal">
            <div class="form-group">
                <input type="text" placeholder="Put your name" name="namex" id="namex">
                <div id="nameError" class="error"></div>
            </div>

            <div class="form-group">
                <input type="text" placeholder="Put your surname" name="surname" id="surname">
                <div id="surnameError" class="error"></div>
            </div>
        </div>

        <!-- Username, Email, and Password (one per line) -->
        <div class="form-group">
            <input type="text" placeholder="Put your username" name="name" id="name">
            <div id="usernameError" class="error"></div>
        </div>

        <div class="form-group">
            <input type="email" placeholder="Email" name="email" id="email">
            <div id="emailError" class="error"></div>
        </div>

        <div class="form-group">
            <input type="password" placeholder="Password" name="pass" id="pass">
            <div id="passwordError" class="error"></div>
        </div>

        <!-- Gender displayed horizontally -->
        <div class="form-group radio-group">
            <label for="genderMale">Male</label>
            <input type="radio" name="gender" value="Male" id="genderMale">
            <label for="genderFemale">Female</label>
            <input type="radio" name="gender" value="Female" id="genderFemale">
            <label for="genderOther">Other</label>
            <input type="radio" name="gender" value="Other" id="genderOther">
            <div id="genderError" class="error"></div>
        </div>

        <!-- Birthdate and Phone Number displayed horizontally -->
        <div class="form-group form-group-horizontal">
            <div class="form-group">
                <input type="date" name="birthdate" id="birthdate">
                <div id="birthdateError" class="error"></div>
            </div>

            <div class="form-group">
                <input type="text" placeholder="Phone Number" name="phone" id="phone">
                <div id="phoneError" class="error"></div>
            </div>
        </div>

        <!-- Sign Up Button -->
        <input type="submit" id="send" value="Sign Up">
        
        <!-- Error message display -->
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
        // Custom validation script
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
            }

            // Validate surname
            const surnamePattern = /^[A-Za-z]+$/;
            if (!surname) {
                document.getElementById("surnameError").textContent = "Surname is required.";
                isValid = false;
            } else if (!surnamePattern.test(surname)) {
                document.getElementById("surnameError").textContent = "Surname must contain only letters.";
                isValid = false;
            }

            // Validate username
            if (!username) {
                document.getElementById("usernameError").textContent = "Username is required.";
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
            }

            // Prevent form submission if validation fails
            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>
</body>
</html>
