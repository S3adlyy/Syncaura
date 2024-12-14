<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" type="image/x-icon" href="img.png">
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
        input[type="submit"] {
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

        input[type="submit"]:hover {
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
</head>
<body>
    <form id="registrationForm" action="../../../controller/usersign/SignupController.php" method="post" enctype="multipart/form-data">
        <h1>Signup Form</h1>

        <!-- Name and Surname -->
        <div>
            <input type="text" placeholder="Put your name" name="namex" id="namex" required>
            <div id="nameError" class="error"></div>
        </div>
        <div>
            <input type="text" placeholder="Put your surname" name="surname" id="surname" required>
            <div id="surnameError" class="error"></div>
        </div>

        <!-- Username -->
        <div>
            <input type="text" placeholder="Put your username" name="name" id="name" required>
            <div id="usernameError" class="error"></div>
        </div>

        <!-- Email -->
        <div>
            <input type="email" placeholder="Email" name="email" id="email" required>
            <div id="emailError" class="error"></div>
        </div>

        <!-- Password -->
        <div>
            <input type="password" placeholder="Password" name="pass" id="pass" required>
            <div id="passwordError" class="error"></div>
        </div>

        <!-- Gender -->
        <div>
            <label for="genderMale">Male</label>
            <input type="radio" name="gender" value="Male" id="genderMale">
            <label for="genderFemale">Female</label>
            <input type="radio" name="gender" value="Female" id="genderFemale">
            <div id="genderError" class="error"></div>
        </div>

        <!-- Birthdate -->
        <div>
            <input type="date" name="birthdate" id="birthdate" required>
            <div id="birthdateError" class="error"></div>
        </div>

        <!-- Phone Number -->
        <div>
            <input type="text" placeholder="Phone Number" name="phone" id="phone" required>
            <div id="phoneError" class="error"></div>
        </div>

        <!-- Profile Picture -->
        <div>
            <input type="file" name="profilePicture" id="profilePicture" accept="image/*">
            <div id="profilePictureError" class="error"></div>
        </div>

        <!-- Submit Button -->
        <input type="submit" value="Sign Up">

        <!-- Error message display -->
        <div id="php-error-messages">
            <?php
            if (isset($_GET['error'])) {
                $error_message = $_GET['error'] == 2 ? "Username or email already exists." : "";
                echo '<p>' . $error_message . '</p>';
            }
            ?>
        </div>
        <p>Already a member? <a href="signin.php" style="color: blue;">Sign In</a></p>
    </form>

    <script>
        document.getElementById("registrationForm").addEventListener("submit", function(event) {
        // Clear error messages
        document.querySelectorAll(".error").forEach(el => el.textContent = "");

        let errors = false;

        //////////////////////////////////////////////////
        // Profile Picture Validation
        const profilePicture = document.getElementById("profilePicture").files[0];
        const allowedExtensions = ["image/jpeg", "image/png", "image/gif"];
        
        if (profilePicture) {
            if (!allowedExtensions.includes(profilePicture.type)) {
                document.getElementById("profilePictureError").textContent = "Invalid file type. Only JPEG, PNG, and GIF are allowed.";
                errors = true;
            } else if (profilePicture.size > 2 * 1024 * 1024) {  // Check if file size exceeds 2MB
                document.getElementById("profilePictureError").textContent = "File size exceeds 2MB.";
                errors = true;
            }
        }

        //////////////////////////////////////////////////
        // Name validation
        let name = document.getElementById('namex').value;
        if (name === '') {
            errors = true;
            document.getElementById('nameError').textContent = 'Name is required.';
        }

        // Surname validation
        let surname = document.getElementById('surname').value;
        if (surname === '') {
            errors = true;
            document.getElementById('surnameError').textContent = 'Surname is required.';
        }

        // Username validation
        let username = document.getElementById('name').value;
        if (username === '') {
            errors = true;
            document.getElementById('usernameError').textContent = 'Username is required.';
        } else if (username.length < 3) {
            errors = true;
            document.getElementById('usernameError').textContent = 'Username must be at least 3 characters long.';
        } else if (/^\d+$/.test(username)) {  // Check if username contains only numbers
            errors = true;
            document.getElementById('usernameError').textContent = 'Username cannot contain only numbers.';
        }

        // Email validation
        let email = document.getElementById('email').value;
        let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailPattern.test(email)) {
            errors = true;
            document.getElementById('emailError').textContent = 'Please enter a valid email address.';
        }

        // Password validation
        let password = document.getElementById('pass').value;
        if (password === '') {
            errors = true;
            document.getElementById('passwordError').textContent = 'Password is required.';
        } else if (password.length < 6) {
            errors = true;
            document.getElementById('passwordError').textContent = 'Password must be at least 6 characters long.';
        }

        // Gender validation
        let gender = document.querySelector('input[name="gender"]:checked');
        if (!gender) {
            errors = true;
            document.getElementById('genderError').textContent = 'Gender is required.';
        }

        // Birthdate validation
        let birthdate = document.getElementById('birthdate').value;
        if (birthdate === '') {
            errors = true;
            document.getElementById('birthdateError').textContent = 'Birthdate is required.';
        }

        // Phone number validation
        let phone = document.getElementById('phone').value;
        let phonePattern = /^[0-9]{10}$/;  // Assumes a 10-digit phone number
        if (!phonePattern.test(phone)) {
            errors = true;
            document.getElementById('phoneError').textContent = 'Please enter a valid phone number.';
        }

        // Prevent submission if there are errors
        if (errors) {
            event.preventDefault();
        }
    });
    </script>
</body>
</html>
