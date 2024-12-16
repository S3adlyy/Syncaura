<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="imggg.png">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

  <link href="https://fonts.googleapis.com/css2?family=Display+Playfair:wght@400;700&family=Inter:wght@400;700&display=swap" rel="stylesheet">


  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/stylo.css">

    <style>
        /* Reset default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* General body styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #282c34;
            margin: 0;
            padding: 50px 0;
            overflow: hidden;
        }

        .spline-viewer {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        /* Form Container */
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            position: relative;
            z-index: 2;
           margin-left: 30px;
           

        }

        .form-container h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        /* Form Input and Button Styling */
        label {
            font-size: 14px;
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            color: #555;
            outline: none;
        }

        input[type="text"]:focus,
        input[type="date"]:focus {
            border-color: #4e73df;
        }

        /* Submit Button Styling */
        button {
            width: 48%;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        /* Add Button Styling */
        button[type="submit"] {
            background-color: #28a745;
            color: #fff;
        }

        button[type="submit"]:hover {
            background-color: #218838;
        }

        /* Return Button Styling */
        button[type="button"] {
            background-color: #007bff;
            color: #fff;
        }

        button[type="button"]:hover {
            background-color: #0056b3;
        }

        /* Error Message Styling */
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }

        /* Responsive Design for Small Screens */
        @media (max-width: 600px) {
            .form-container {
                width: 100%;
                padding: 15px;
            }

            button {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<nav class="site-nav mb-5 sticky-nav">
    <div class="container position-relative">
        <div class="site-navigation text-center">
            <a href="loading_screen/loadng.html" class="logo menu-absolute m-0" align="left">SyncAura<span class="text-primary">.</span></a>
            <ul class="site-menu d-flex justify-content-center align-items-center">
            <li><a href="../front/createmeet/loadng2.php">Cree un meet</a></li>
            <li><a href="./Ai/loding3.php">Ai ChatBot</a></li>
                <li><a href="./promodor/index.php">Pomodoro Timer</a></li>
                <li><a href="loading_screen/loadng.php">buy a pack</a></li>
                <li><a href="todo.php">To Do List</a></li>
                <li><a href="supportClient.php">client support</a></li>
                <li><a href="../loading_screen/loadng.html">Chat</a></li>
                <li><a href="../loading_screen/loadng.html">Sharefiles</a></li>
                <li><a href="../loading_screen/loadng.html">Modify Account</a></li>
                <li><a href="../loading_screen/loadng.html">Code Editor</a></li>
                <li><a href="../loading_screen/loadng.html">Blog</a></li>
                <li><a href="../media/media.html">social media</a></li>
                <li><a href="../coming_soon/loading.html">Whiteboard</a></li>
                
            </ul>
        </div>
    </div>
</nav>
<body>
<div class="spline-viewer">
    <spline-viewer url="https://prod.spline.design/BK83Flm76SwRJlHz/scene.splinecode"></spline-viewer>
    </div>
    <br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
    <!-- Form to Add New Question -->
    <div id="formContainer" class="form-container">
        <h3>Enter New Question</h3>
        <form id="questionForm" action="ajouter_question.php" method="post">

            <label for="question">Question:</label>
            <input type="text" id="question" name="question">

            <label for="date_creation">Date Creation:</label>
            <input type="text" id="date_creation" name="date_creation" placeholder="YYYY-MM-DD">

            <label for="type">Type:</label>
            <input type="text" id="type" name="type">

            <button type="submit">Ajouter</button>
            <button type="button" onclick="window.location.href='supportClient.php'">Retour à la liste</button>
        </form>

        <!-- Error message container -->
        <div id="errorMessage" class="error-message"></div>
    </div>

    <script>
        // Function to validate form inputs
        function validateForm() {
            let errorMessages = [];

            // Get form values
            const question = document.getElementById('question').value.trim();
            const dateCreation = document.getElementById('date_creation').value.trim();
            const type = document.getElementById('type').value.trim();

            // Validate question
            if (question === '') {
                errorMessages.push('La question ne peut pas être vide.');
            }

            // Validate date creation (in YYYY-MM-DD format)
            const datePattern = /^\d{4}-\d{2}-\d{2}$/;
            if (dateCreation === '' || !datePattern.test(dateCreation)) {
                errorMessages.push('La date de création doit être dans le format YYYY-MM-DD.');
            }

            // Validate type
            if (type === '') {
                errorMessages.push('Le type ne peut pas être vide.');
            }

            // If there are error messages, display them and prevent form submission
            if (errorMessages.length > 0) {
                document.getElementById('errorMessage').innerHTML = errorMessages.join('<br>');
                return false;
            }

            // If no errors, submit the form
            return true;
        }

        // Attach validation function to form submission
        document.getElementById('questionForm').onsubmit = function() {
            return validateForm();
        };
    </script>
    <script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.48/build/spline-viewer.js"></script>
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
