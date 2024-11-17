<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register</title>

    <!-- Fonts and CSS -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">

    <style>
        body {
            background-color: #007BFF;
            font-family: 'Nunito', sans-serif;
        }

        .login-container {
            background: linear-gradient(135deg, #007BFF 0%, #0056b3 100%);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 500px;
            margin: auto;
            margin-top: 5%;
        }

        .form-control-user {
            border: 1px solid #d1d3e2;
            padding: 15px;
            border-radius: 10px;
            background-color: #f8f9fc;
            transition: all 0.3s;
        }

        .form-control-user:focus {
            border-color: #FFD700;
            box-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
            outline: none;
        }

        .btn-user {
            border-radius: 10px;
            padding: 10px 20px;
            font-size: 1rem;
            width: 100%;
        }

        .btn-user:hover {
            background-color: #2e59d9;
        }

        .btn-google {
            background-color: #FF5733;
            color: white;
        }

        .btn-google:hover {
            background-color: #e63900;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="login-container">
            <div class="text-center">
                <h1 class="h4 mb-4">Create an Account!</h1>
            </div>
            <form id="registrationForm" action="config.php" method="post">
    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <input type="text" id="name" name="name" class="form-control form-control-user" placeholder="First Name">
            <span id="nameError" style="color: red;"></span> <!-- Error message for name -->
        </div>
    </div>
    <div class="form-group">
        <input type="text" id="email" name="email" class="form-control form-control-user" placeholder="Email Address">
        <span id="emailError" style="color: red;"></span> <!-- Error message for email -->
    </div>
    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <input type="password" id="password" name="password" class="form-control form-control-user" placeholder="Password">
            <span id="passwordError" style="color: red;"></span> <!-- Error message for password -->
        </div>
    </div>
    <input type="submit" id="submit" name="send" value="Create Account" class="btn btn-primary btn-user">
    <hr>
    <div class="text-center">
        <a class="small" href="login.php">Already have an account? Login!</a>
    </div>
</form>
        </div>
    </div>

    <script>
        // JavaScript 
        document.getElementById("registrationForm").addEventListener("submit", function(event) {
            // Clear previous error messages
            document.getElementById("nameError").textContent = "";
            document.getElementById("emailError").textContent = "";
            document.getElementById("passwordError").textContent = "";

            // Get form values
            const username = document.getElementById("name").value.trim();
            const email = document.getElementById("email").value.trim();
            const password = document.getElementById("password").value.trim();

            let isValid = true;

            // Validate Username
            if (!username) {
                document.getElementById("nameError").textContent = "Username is required.";
                isValid = false;
            } else if (username.length < 3) {
                document.getElementById("nameError").textContent = "Username must be at least 3 characters.";
                isValid = false;
            }

            // Validate Email
            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!email) {
                document.getElementById("emailError").textContent = "Email is required.";
                isValid = false;
            } else if (!emailPattern.test(email)) {
                document.getElementById("emailError").textContent = "Please enter a valid email address.";
                isValid = false;
            }

            // Validate Password
            if (!password) {
                document.getElementById("passwordError").textContent = "Password is required.";
                isValid = false;
            } else if (password.length < 8) {
                document.getElementById("passwordError").textContent = "Password must be at least 6 characters.";
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
