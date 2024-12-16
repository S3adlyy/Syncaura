<?php
include 'C:\xampp\htdocs\integration3\configg.php';
include 'C:\xampp\htdocs\integration3\models\questions.php';
include 'C:\xampp\htdocs\integration3\controller\questionsC.php';

$questionsC = new questionsC();

if (isset($_GET['id'])) {
    $id_question = $_GET['id'];
    $questions = $questionsC->listquestion();

    // Trouver la question spécifique à modifier
    $questionToEdit = null;
    foreach ($questions as $question) {
        if ($question['id_question'] == $id_question) {
            $questionToEdit = $question;
            break;
        }
    }

    // Si la question existe
    if (!$questionToEdit) {
        die("Question not found");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_question'])) {
    // Récupérer les nouvelles valeurs du formulaire
    $updatedQuestion = new questions(
        $_POST['id_question'],
        $_POST['questions'],
        new DateTime($_POST['date_creation']),
        $_POST['id'],
        $_POST['type']
    );

    // Appeler la fonction update
    if ($questionsC->updatequestion($updatedQuestion, $updatedQuestion->getid_question())) {
        echo "Question updated successfully!";
    } else {
        echo "Failed to update question.";
    }
}
?>

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

        /* Background gradient animation */
        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Form container */
        .form-container {
            position: relative;
            z-index: 2;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding: 30px;
        }

        /* Form card */
        .form-card {
            width: 500px;
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
            padding: 30px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(225, 228, 232, 0.7);
        }

        .form-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        /* Form title */
        .form-card h2 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Form elements */
        .form-card label {
            display: block;
            font-size: 16px;
            color: #555;
            margin-bottom: 5px;
        }

        .form-card input[type="text"],
        .form-card input[type="number"],
        .form-card input[type="date"],
        .form-card textarea {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-bottom: 20px;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .form-card input:focus,
        .form-card textarea:focus {
            border-color: #007bff;
        }

        /* Button styling */
        .form-card button {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            width: 100%;
        }

        .form-card button:hover {
            transform: scale(1.05);
        }

        /* Responsive design */
        @media (max-width: 600px) {
            .form-card {
                width: 90%;
            }
        }

        .error {
            color: red;
            font-size: 14px;
        }
    </style>
    <script>
        // Client-side validation using JavaScript
        function validateForm() {
            var question = document.getElementById('questions').value;
            var dateCreation = document.getElementById('date_creation').value;
            var type = document.getElementById('type').value;
            var errorMessage = '';

            // Clear previous error messages
            document.getElementById('error_message').innerHTML = '';

            // Validate 'question' field
            if (question.trim() === '') {
                errorMessage += 'La question est obligatoire.\n';
            }

            // Validate 'date_creation' field
            if (dateCreation === '') {
                errorMessage += 'La date de création est obligatoire.\n';
            }

            // Validate 'type' field
            if (type.trim() === '') {
                errorMessage += 'Le type est obligatoire.\n';
            }

            if (errorMessage !== '') {
                document.getElementById('error_message').innerHTML = errorMessage.replace(/\n/g, '<br>');
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
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



<div class="form-container">
    <div class="form-card">
        <h2>Modifier la Question</h2>

        <div id="error_message" class="error"></div>

        <form method="post" onsubmit="return validateForm()">
            <input type="hidden" name="id_question" value="<?php echo htmlspecialchars($questionToEdit['id_question']); ?>">

            <label for="questions">Question:</label>
            <input type="text" id="questions" name="questions" value="<?php echo htmlspecialchars($questionToEdit['questions']); ?>">

            <label for="date_creation">Date de Création:</label>
            <input type="date" id="date_creation" name="date_creation" value="<?php echo htmlspecialchars($questionToEdit['date_creation']); ?>">

            <label for="id">ID:</label>
            <input type="number" id="id" name="id" value="<?php echo htmlspecialchars($questionToEdit['id']); ?>">

            <label for="type">Type:</label>
            <input type="text" id="type" name="type" value="<?php echo htmlspecialchars($questionToEdit['type']); ?>">

            <button type="submit">Modifier</button>
        </form>
    </div>
</div>
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
