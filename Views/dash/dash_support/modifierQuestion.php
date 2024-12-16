<?php
include 'C:\xampp\htdocs\integration3\configg.php';
include_once "../models/questions.php";
include_once "../controller/questionsC.php";


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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Question</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* General body styling */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #88caff, #4f80ff, #6240f5);
            background-size: 400% 400%;
            animation: gradientAnimation 15s ease infinite;
        }

        /* Background gradient animation */
        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Form container */
        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
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

</body>
</html>
