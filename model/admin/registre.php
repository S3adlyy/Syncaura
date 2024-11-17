<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="styles.css" rel="stylesheet">

    <style>
        body {
            background-color: #007BFF; /* Blue background */
            font-family: 'Nunito', sans-serif;
        }

        .login-container {
            background: linear-gradient(135deg, #007BFF 0%, #0056b3 100%); /* Gradient background */
            padding: 30px;
            border-radius: 15px; /* Rounded corners */
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3); /* Shadow for depth */
            width: 100%; /* Full width for the card */
            max-width: 500px; /* Max width to keep it neat */
            margin: auto; /* Center it */
            margin-top: 5%; /* Space from the top */
        }

        .form-control-user {
            border: 1px solid #d1d3e2;
            padding: 15px;
            font-size: 0.875rem;
            border-radius: 10px;
            color: #6e707e;
            background-color: #f8f9fc;
            transition: all 0.3s ease;
        }

        .form-control-user:focus {
            border-color: #FFD700; /* Gold border on focus */
            box-shadow: 0 0 10px rgba(255, 215, 0, 0.5); /* Gold shadow */
            outline: none;
            background-color: #fff;
        }

        .btn-user {
            border-radius: 10px;
            padding: 10px 20px;
            font-size: 1rem;
            transition: background-color 0.3s;
            width: 100%; /* Full width buttons */
        }

        .btn-user:hover {
            background-color: #2e59d9; /* Darker blue on hover */
        }

        .btn-google {
            background-color: #FF5733; /* Red button for Google */
            color: white;
        }

        .btn-google:hover {
            background-color: #e63900; /* Darker red on hover */
        }

        .text-center h1 {
            color: white; /* Change text color to white for contrast */
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5); /* Subtle text shadow */
        }

        .error {
            color: red;
            margin-top: 5px;
            font-size: 0.85rem; /* Smaller font size for error messages */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="login-container"> <!-- Use the same class for styling -->
            <div class="text-center">
                <h1 class="h4 mb-4">Create an Account!</h1>
            </div>
            <form id="registerForm" action="config.php" method="post">
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

                <!-- Google Sign-In Button Integration -->
                <div id="g_id_onload"
                    data-client_id="92043718583-dfre0ss4bd1gvo8mo4vk099co2acop2d.apps.googleusercontent.com"
                    data-context="signup"
                    data-ux_mode="popup"
                    data-callback="login"
                    data-auto_prompt="false">
                </div>

                <div class="g_id_signin btn-google"
                    data-type="standard"
                    data-shape="rectangular"
                    data-theme="outline"
                    data-text="signin_with"
                    data-size="large"
                    data-logo_alignment="left">
                </div>
            </form>
            <hr>
            <div class="text-center">
                <a class="small" href="login.php">Already have an account? Login!</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Google Sign-In API -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>

    <script>
        // JavaScript validation
        document.getElementById("registerForm").addEventListener("submit", function(event) {
            // Clear previous error messages
            document.getElementById("nameError").textContent = "";
            document.getElementById("emailError").textContent = "";
            document.getElementById("passwordError").textContent = "";

            // Get form values
            const name = document.getElementById("name").value.trim();
            const email = document.getElementById("email").value.trim();
            const password = document.getElementById("password").value.trim();

            let isValid = true;

            // Validate Name
            if (!name) {
                document.getElementById("nameError").textContent = "First Name is required.";
                isValid = false;
            }

            // Validate Email 
            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!email) {
                document.getElementById("emailError").textContent = "Email Address is required.";
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
                document.getElementById("passwordError").textContent = "Password must be at least 8 characters.";
                isValid = false;
            }

            // If validation fails, prevent form submission
            if (!isValid) {
                event.preventDefault();
            }
        });

        // Google login callback function
        function login(response) {
            console.log(response);
            // Handle the Google sign-in response here

        }
    </script>
</body>
</html>
