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
            padding: 15px 25px;  
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
            font-size: 20px;  
            margin-bottom: 15px;
        }

        /* Input fields */
        input[type="text"],
        input[type="password"],
        input[type="date"],
        input[type="radio"],
        input[type="email"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0;  
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;  
        }

        /* Placeholder styling */
        input::placeholder {
            color: #888;
        }

        /* Label for radio buttons */
        label {
            margin-right: 8px; 
            font-size: 14px;   
        }

        /* Form Group */
        .form-group {
            margin-bottom: 12px; 
        }

        .form-group-horizontal {
            display: flex;
            justify-content: space-between;
            gap: 8px; 
        }

        .form-group-horizontal .form-group {
            width: calc(50% - 4px);  
        }

        /* Error messages */
        .error {
            color: red;
            font-size: 12px;  
            margin-top: 4px;  
            display: block;
        }

        /* Radio buttons container */
        .radio-group {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px; 
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
            margin-top: 15px; 
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
            <input type="text" placeholder="Email" name="email" id="email">
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
                    echo '<p class="error">' . $error_message . '</p>';
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
            document.getElementById("phoneError").textContent = "";

            const name = document.getElementById("namex").value.trim();
            const surname = document.getElementById("surname").value.trim();
            const username = document.getElementById("name").value.trim();
            const email = document.getElementById("email").value.trim();
            const password = document.getElementById("pass").value.trim();
            const phone = document.getElementById("phone").value.trim();

            let isValid = true;

            // Validate name
            const namePattern = /^[A-Za-z]+$/;
            if (!name) {
                document.getElementById("nameError").textContent = "Name is required.";
                isValid = false;
            } else if (!namePattern.test(name)) {
                document.getElementById("nameError").textContent = "Name must contain only letters.";
                isValid = false;
            } else if (name.length < 3) {
                document.getElementById("nameError").textContent = "Name minimum length is 3 characters.";
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
            } else if (surname.length < 3) {
                document.getElementById("surnameError").textContent = "Surname minimum length is 3 characters.";
                isValid = false;
            }

            // Validate username
            const usernamePattern = /^[A-Za-z0-9]+$/;
            if (!username) {
                document.getElementById("usernameError").textContent = "Username is required.";
                isValid = false;
            } else if (username.length < 3) {
                document.getElementById("usernameError").textContent = "Username minimum length is 3 characters.";
                isValid = false;
            } else if (/^\d+$/.test(username)) {
                document.getElementById("usernameError").textContent = "Username cannot be composed of only numbers.";
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
            const passwordPattern = /^(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/;
            if (!password) {
                document.getElementById("passwordError").textContent = "Password is required.";
                isValid = false;
            } else if (password.length < 8) {
                document.getElementById("passwordError").textContent = "Password minimum length is 8 characters.";
                isValid = false;
            } else if (!passwordPattern.test(password)) {
                document.getElementById("passwordError").textContent = "Password must contain at least one number and one symbol.";
                isValid = false;
            }

           // Validate phone number
const phonePattern = /^[0-9]{9,}$/;  // Ensure phone number is numeric and at least 9 digits
if (!phone) {
    document.getElementById("phoneError").textContent = "Phone number is required.";
    isValid = false;
} else {
    const cleanedPhone = phone.replace(/\D/g, '');  // Remove non-numeric characters (like spaces or dashes)
    if (!cleanedPhone) {
        document.getElementById("phoneError").textContent = "Phone number must contain only numbers.";
        isValid = false;
    } else if (cleanedPhone.length < 9) {
        document.getElementById("phoneError").textContent = "Phone number must contain at least 9 digits.";
        isValid = false;
    }
}


            // Prevent form submission if validation fails
            if (!isValid) {
                event.preventDefault();
            }
        });
    
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
