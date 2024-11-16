<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un plan</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f5;
        }

        .container {
            text-align: center;
            padding: 30px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h1 {
            margin-bottom: 20px;
        }

        input[type="text"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007BFF;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="container">
        <form action="../../../model/import.php" method="post" onsubmit="return validateForm()">
            <h1>Ajoutez un nom à votre plan</h1>
            <input type="text" id="planName" placeholder="Entrez le nom de votre plan" name="name">
            <div id="errorMessage" style="color: red; display: none;">Le nom du plan ne peut pas être vide.</div><br>
            <button type="submit">Créer le plan</button>
        </form>

        <script>
            function validateForm() {
                const planName = document.getElementById("planName").value.trim();
                const errorMessage = document.getElementById("errorMessage");

                if (planName === "") {
                    // Show the error message below the input
                    errorMessage.style.display = "block";
                    return false;  // Prevent form submission
                }

                // Hide the error message if input is valid
                errorMessage.style.display = "none";

                return true;  // Allow form submission
            }
        </script>
    </div>

</body>
</html>