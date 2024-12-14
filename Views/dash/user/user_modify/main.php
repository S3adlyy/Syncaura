<!doctype html>
<html lang="en">

<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" type="image/x-icon" href="icon.png">


  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

  <link href="https://fonts.googleapis.com/css2?family=Display+Playfair:wght@400;700&family=Inter:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/animate.min.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="flaticon.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
  <link rel="stylesheet" href="css/aos.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/stylo.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="imgggg.png">
    <title>Change Password and Username</title>
    <style>
        /* Additional styling */
        .form-container {
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            margin: auto;
            position: relative;
            z-index: 2;

        }

        .form-container h3 {
            margin-bottom: 20px;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .spline-viewer {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            z-index: 1;
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
<nav class="site-nav mb-5 sticky-nav">
    <div class="container position-relative">
        <div class="site-navigation text-center">

            <ul class="site-menu d-flex justify-content-center align-items-center">
                <li><a href="../../../front/loading_screen/loading_meet.html">Cree un meet</a></li>
                <li><a href="../../../front/Ai/loding3.html">Ai ChatBot</a></li>
                <li><a href="../../../front/loading_screen/loading_p.html">Pomodoro Timer</a></li>
                <li><a href="../../../front/loading_screen/loadngg.php">Acheter un Pack</a></li>
                <li><a href="../../../front/todolist/loading_todo.html">To Do List</a></li>
                <li><a href="../../../front/loading_screen/loading_support.html">Support Client</a></li>
                <li><a href="../../../front/loading_screen/loadng.html">Chat</a></li>
                <li><a href="../../../front/loading_screen/loading_share.html">Share files</a></li>
                <li><a href="../../../front/loading_screen/laoding_modif.html">Modify Account</a></li>
                <li><a href="../../../front/loading_screen/loading_editor.html">Code Editor</a></li>
                <li><a href="../../../front/loading_screen/loading_thome.html">Blog</a></li>
            </ul>
        </div>
    </div>
</nav>
  
    <div class="spline-viewer">
    <spline-viewer url="https://prod.spline.design/BK83Flm76SwRJlHz/scene.splinecode"></spline-viewer>
    </div>
        <br>
        <br>
        <br>
        <br>
    <div class="form-container">
        <h3>Change Your Details</h3>
        <form action="user_modify.php" method="POST" id="updateForm" enctype="multipart/form-data">
            <!-- Username -->
            <div class="form-group">
                <label for="username">New Username:</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Enter new username">
                <small id="usernameError" class="form-text text-danger"></small>
            </div>
            <!-- Password -->
            <div class="form-group">
                <label for="current_password">Current Password:</label>
                <input type="password" id="current_password" name="current_password" class="form-control" placeholder="Enter current password">
                <small id="currentPasswordError" class="form-text text-danger"></small>
            </div>
            <!-- New Password -->
            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" class="form-control" placeholder="Enter new password">
                <small id="newPasswordError" class="form-text text-danger"></small>
            </div>
            <!-- Confirm New Password -->
            <div class="form-group">
                <label for="confirm_password">Confirm New Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm new password">
                <small id="confirmPasswordError" class="form-text text-danger"></small>
            </div>
            <!-- Profile Picture -->
            <div class="form-group">
                <label for="profile_picture">Upload Profile Picture:</label>
                <input type="file" id="profile_picture" name="profile_picture" class="form-control">
                <small id="profilePictureError" class="form-text text-danger"></small>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Update Details</button>

            <!-- PHP error messages (if any) will be displayed here -->
            <div id="error-messages" class="error-messages">
                <?php if (isset($_GET['error'])): ?>
                    <?php
                        $error_message = '';
                        if ($_GET['error'] == 1) {
                            $error_message = "Password is required.";
                        } 
                        echo "<p>{$error_message}</p>";
                    ?>
                <?php endif; ?>
            </div>
        </form>

        <script>
            document.getElementById("updateForm").addEventListener("submit", function(event) {
                let isValid = true;
                const errorBlock = document.getElementById("error-messages");

                // Clear previous errors
                document.getElementById("usernameError").textContent = "";
                document.getElementById("currentPasswordError").textContent = "";
                document.getElementById("newPasswordError").textContent = "";
                document.getElementById("confirmPasswordError").textContent = "";
                document.getElementById("profilePictureError").textContent = "";

                // Validate new username (if provided)
                const username = document.getElementById("username").value;
                if (username && username.length < 3) {
                    document.getElementById("usernameError").textContent = "Username must be at least 3 characters long.";
                    isValid = false;
                }else if (/^\d+$/.test(username)) {  // Check if username contains only numbers
            errors = true;
            document.getElementById('usernameError').textContent = 'Username cannot contain only numbers.';
        }

                // Validate current password (always required)
                const currentPassword = document.getElementById("current_password").value;
                if (currentPassword.trim() === "") {
                    document.getElementById("currentPasswordError").textContent = "Current password is required.";
                    isValid = false;
                }

                // Validate new password (only if a new password is entered)
                const newPassword = document.getElementById("new_password").value;
                const confirmPassword = document.getElementById("confirm_password").value;
                if (newPassword || confirmPassword) {
                    if (newPassword.length < 8) {
                        document.getElementById("newPasswordError").textContent = "New password must be at least 8 characters long.";
                        isValid = false;
                    }

                    // Check for at least one number and one symbol
                    const passwordPattern = /^(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>]).+$/;
                    if (!passwordPattern.test(newPassword)) {
                        document.getElementById("newPasswordError").textContent = "New password must contain at least one number and one symbol.";
                        isValid = false;
                    }

                    if (newPassword !== confirmPassword) {
                        document.getElementById("confirmPasswordError").textContent = "Confirm password must match the new password.";
                        isValid = false;
                    }
                }

                // Validate profile picture (if provided)
                const profilePicture = document.getElementById("profile_picture").files[0];
                if (profilePicture && !['image/jpeg', 'image/png', 'image/gif'].includes(profilePicture.type)) {
                    document.getElementById("profilePictureError").textContent = "Only JPG, PNG, and GIF files are allowed.";
                    isValid = false;
                }

                // Show error block if there are errors
                if (!isValid) {
                    errorBlock.style.display = "block";
                    event.preventDefault(); // Prevent form submission
                } else {
                    errorBlock.style.display = "none"; // Hide error block if no errors
                }
            });
        </script>
    </div>

    <script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.35/build/spline-viewer.js"></script>
    <script>
        window.onload = function () {
            const shadowRoot = document.querySelector('spline-viewer').shadowRoot;
            if (shadowRoot) {
                const logo = shadowRoot.querySelector('#logo');
                if (logo) logo.remove();
            }
        }
    </script>
</body>

</html>
