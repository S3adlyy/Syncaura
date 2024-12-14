<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" href="imgggg.png">
    <style>
        form {
    background: rgba(255, 255, 255, 0.15); /* Glassmorphism effect */
    backdrop-filter: blur(20px); /* Stronger blur */
    padding: 50px;
    border-radius: 25px; /* Softer rounded corners */
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.6); /* Elevated shadow */
    width: 380px; /* Slightly wider for better spacing */
    animation: dropIn 0.8s ease-in-out; /* Smooth animation for form entry */
    position: relative;
    z-index: 2;
}

@keyframes dropIn {
    from {
        transform: translateY(-50px) scale(0.95); /* Drop in with slight zoom */
        opacity: 0;
    }
    to {
        transform: translateY(0) scale(1); /* Normal size and position */
        opacity: 1;
    }
}

h1 {
    color: #ffffff; /* White text for contrast */
    text-align: center;
    font-size: 30px;
    font-weight: bold;
    margin-bottom: 25px;
    text-shadow: 0 3px 12px rgba(0, 0, 0, 0.5); /* Glowing effect */
}

input[type="text"],
input[type="email"],
input[type="password"],
input[type="date"],
input[type="file"] {
    width: 100%;
    padding: 14px;
    margin-bottom: 20px;
    border: none;
    border-radius: 12px;
    font-size: 16px;
    background: rgba(255, 255, 255, 0.9); /* Softer background */
    color: #333;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    transition: box-shadow 0.3s, transform 0.3s; /* Smooth interactions */
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="password"]:focus,
input[type="date"]:focus,
input[type="file"]:focus {
    box-shadow: 0 6px 20px rgba(0, 123, 255, 0.5); /* Brighter glow */
    transform: translateY(-2px); /* Subtle lift */
    outline: none;
}

input[type="radio"] {
    margin: 0 10px;
    transform: scale(1.2);
}

label {
    font-size: 16px;
    color: #fff;
    margin-right: 15px;
}

input[type="submit"] {
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

input[type="submit"]:hover {
    background: linear-gradient(135deg, #33ccff, #0066ff); 
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4); 
}

.error {
    font-size: 14px;
    color: #ff4d4d; /* Red for errors */
    margin-top: -15px;
    margin-bottom: 10px;
    text-shadow: 0 1px 5px rgba(255, 77, 77, 0.5); /* Subtle glow */
}  
.form-image-container {
    text-align: center;
    margin-bottom: 20px;
}

.form-image {
    width: 100%;
    max-width: 150px;
    border-radius: 50%; /* Circular image */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); /* Cool shadow */
    transition: transform 0.3s ease;
}

.form-image:hover {
    transform: scale(1.1); /* Slight zoom on hover */
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
}
    </style>
</head>
<body>
<div class="spline-viewer">
<spline-viewer url="https://prod.spline.design/O4wdVneKYyKKbJbX/scene.splinecode"></spline-viewer>
    </div>
    <form id="registrationForm" action="../../../controller/usersign/SignupController.php" method="post" enctype="multipart/form-data">
        <h1>Signup Form</h1>
        <div class="form-image-container">
        <img src="imgggg.png" alt="Signup Illustration" class="form-image">
    </div>
        <!-- Name and Surname -->
        <div>
            <input type="text" placeholder="Put your name" name="namex" id="namex" >
            <div id="nameError" class="error"></div>
        </div>
        <div>
            <input type="text" placeholder="Put your surname" name="surname" id="surname" >
            <div id="surnameError" class="error"></div>
        </div>

        <!-- Username -->
        <div>
            <input type="text" placeholder="Put your username" name="name" id="name" >
            <div id="username-error" class="error"></div>
        </div>

        <!-- Email -->
        <div>
            <input type="text" placeholder="Email" name="email" id="email" >
            <div id="email-error" class="error"></div>
        </div>

        <!-- Password -->
        <div>
            <input type="password" placeholder="Password" name="pass" id="pass" >
            <div id="password-error" class="error"></div>
        </div>

        <!-- Gender -->
        <div>
    <label for="genderMale">Male</label>
    <input type="radio" name="gender" value="Male" id="genderMale">
    <label for="genderFemale">Female</label>
    <input type="radio" name="gender" value="Female" id="genderFemale">
    <div id="genderError" class="error"></div>
</div>
<br>

        <!-- Birthdate -->
        <div>
            <input type="date" name="birthdate" id="birthdate" >
            <div id="birthdateError" class="error"></div>
        </div>

        <!-- Phone Number -->
        <div>
            <input type="text" placeholder="Phone Number" name="phone" id="phone" >
            <div id="phoneError" class="error"></div>
        </div>

        <!-- Profile Picture -->
        <div>
            <input type="file" name="profilePicture" id="profilePicture" accept="image/*">
            <div id="profilePictureError" class="error"></div>
        </div>

        <!-- Submit Button -->
        <input type="submit" value="Sign Up" class="button">

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
        }else if (!/^[a-zA-Z]+$/.test(name)) {
        errors = true;
        document.getElementById('nameError').textContent = 'Name can only contain letters.';
    }

        // Surname validation
        let surname = document.getElementById('surname').value;
        if (surname === '') {
            errors = true;
            document.getElementById('surnameError').textContent = 'Surname is required.';
        } else if (!/^[a-zA-Z]+$/.test(surname)) {
        errors = true;
        document.getElementById('surnameError').textContent = 'Surname can only contain letters.';
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
        }else if (email ==='')
        {
            errors = true;
            document.getElementById('emailError').textContent = 'email address is required.';
        }

        // Password validation
        let password = document.getElementById('pass').value;
        if (password === '') {
            errors = true;
            document.getElementById('passwordError').textContent = 'Password is required.';
        } else if (password.length < 8) {
            errors = true;
            document.getElementById('passwordError').textContent = 'Password must be at least 8 characters long.';
        }
        // Check for at least one number and one symbol
        const passwordPattern = /^(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>]).+$/;
                    if (!passwordPattern.test(newPassword)) {
                        document.getElementById("PasswordError").textContent = " password must contain at least one number and one symbol.";
                        errors =true;
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
        } else if (phone ==='')
        { errors= true;
            document.getElementById('phoneError').textContent = 'Phone number is required.';

        }

        // Prevent submission if there are errors
        if (errors) {
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
