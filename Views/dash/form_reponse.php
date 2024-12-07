<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Réponse</title>
    <style>
        /* Reset default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Style */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #4f80ff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        /* Header Style */
        h1 {
            text-align: center;
            color: #007bff; /* Blue color */
            margin-bottom: 40px;
            font-weight: 600;
            font-size: 32px;
        }

        /* Form Styling */
        form {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 700px;
            transition: transform 0.3s ease;
        }

        form:hover {
            transform: translateY(-5px);
        }

        /* Label Style */
        label {
            font-size: 18px;
            color: #555;
            margin-bottom: 10px;
            display: block;
            font-weight: 500;
        }

        /* Input and Textarea Fields */
        input[type="number"],
        input[type="text"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 14px 16px;
            margin: 12px 0;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input[type="number"]:focus,
        input[type="text"]:focus,
        input[type="date"]:focus,
        textarea:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
            outline: none;
        }

        /* Textarea Style */
        textarea {
            resize: vertical;
            min-height: 120px;
        }

        /* Submit Button */
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 16px 22px;
            font-size: 18px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
            transform: translateY(-3px);
        }

        input[type="submit"]:active {
            transform: translateY(1px);
        }

        /* Return Button Styling */
        input[type="button"] {
            background-color: red;
            color: white;
            border: none;
            padding: 16px 22px;
            font-size: 18px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        input[type="button"]:hover {
            background-color: #d9534f;
            transform: translateY(-3px);
        }

        input[type="button"]:active {
            transform: translateY(1px);
        }

        /* Form Group Styling */
        .form-group {
            margin-bottom: 25px;
        }

        /* Error Message Styling */
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            form {
                padding: 20px;
                width: 90%;
            }

            input[type="submit"] {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>

    <!-- Form for Adding New Response -->
    <form id="responseForm" action="ajouter_reponse.php" method="POST">
        <h1>Formulaire de Réponse</h1>

        <!-- ID Response -->
        <div class="form-group">
            <label for="id_reponse">ID de la réponse :</label>
            <input type="number" id="id_reponse" name="id_reponse">
        </div>

        <!-- Response Content -->
        <div class="form-group">
            <label for="contenu">Contenu de la réponse :</label>
            <textarea id="contenu" name="contenu" rows="4"></textarea>
        </div>

        <!-- Date Response -->
        <div class="form-group">
            <label for="date_reponse">Date de la réponse :</label>
            <input type="text" id="date_reponse" name="date_reponse" placeholder="YYYY-MM-DD">
        </div>

        <!-- ID Question -->
        <div class="form-group">
            <label for="id_question">ID de la question :</label>
            <input type="number" id="id_question" name="id_question">
        </div>

        <!-- Submit Button -->
        <input type="submit" value="Ajouter la réponse">

        <!-- Back to List Button -->
        <input type="button" value="Retour à la liste" onclick="window.location.href='table_reponse.php'">
        
        <!-- Error Message -->
        <div id="errorMessage" class="error-message"></div>
    </form>

    <script>
        // Function to validate form inputs
        function validateForm() {
            let errorMessages = [];

            // Get form values
            const idReponse = document.getElementById('id_reponse').value.trim();
            const contenu = document.getElementById('contenu').value.trim();
            const dateReponse = document.getElementById('date_reponse').value.trim();
            const idQuestion = document.getElementById('id_question').value.trim();

            // Validate ID Response
            if (idReponse === '') {
                errorMessages.push('L\'ID de la réponse est requis.');
            }

            // Validate response content
            if (contenu === '') {
                errorMessages.push('Le contenu de la réponse est requis.');
            }

            // Validate Date Response (in YYYY-MM-DD format)
            const datePattern = /^\d{4}-\d{2}-\d{2}$/;
            if (dateReponse === '' || !datePattern.test(dateReponse)) {
                errorMessages.push('La date de la réponse doit être dans le format YYYY-MM-DD.');
            }

            // Validate ID Question
            if (idQuestion === '') {
                errorMessages.push('L\'ID de la question est requis.');
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
        document.getElementById('responseForm').onsubmit = function () {
            return validateForm();
        };
    </script>

</body>

</html>
