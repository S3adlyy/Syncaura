<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gemini Pack Description Generator</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      min-height: 100vh;
    }

    h1 {
      color: #004080;
      font-size: 2rem;
      margin-bottom: 20px;
      text-align: center;
      font-weight: 600;
    }

    form {
      background-color: #fff;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
      max-width: 600px;
      width: 100%;
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    label {
      font-size: 1.1em;
      color: #333;
      font-weight: 500;
    }

    input[type="text"] {
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 1em;
      width: 100%;
      margin-bottom: 10px;
    }

    button {
      padding: 12px 20px;
      background-color: #004080;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 1.1em;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #003060;
    }

    #responseOutput {
      margin-top: 30px;
      background-color: #ffffff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
      max-width: 600px;
      width: 100%;
      color: #003060;
      font-size: 1.1em;
      text-align: center;
      font-weight: 500;
    }

    .back-button {
      margin-top: 20px;
      padding: 8px 15px; /* Reduced padding for shorter button */
      background-color: #ff6f61;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 1em; /* Slightly smaller font size */
      cursor: pointer;
      text-align: center;
      transition: background-color 0.3s ease;
    }

    .back-button:hover {
      background-color: #d04b3e;
    }
  </style>
</head>
<body>
  <h1>Générateur de description pour les packs</h1>
  <form action="" method="POST">
    <label for="inputText">Entrez le nom du pack :</label>
    <input type="text" id="inputText" name="inputText" required>
    <button type="submit">Générer</button>
  </form>

  <div id="responseOutput">
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $inputText = $_POST['inputText'] ?? ''; // Récupère le texte envoyé depuis le formulaire
        if (!empty($inputText)) {
            // Clé API et URL de l'API
            $apiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=AIzaSyCAg4jKbmmb0jjIK-kYnGYqN8sCMi_xaa8";

            // Préparer le corps de la requête pour une réponse courte
            $requestBody = [
                "contents" => [
                    [
                        "parts" => [
                            ["text" => "Create a short description for the following pack: " . $inputText]
                        ]
                    ]
                ]
            ];

            // Initialiser cURL
            $ch = curl_init($apiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Content-Type: application/json"
            ]);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestBody));

            // Exécuter la requête et récupérer la réponse
            $response = curl_exec($ch);

            if ($response === false) {
                echo "Erreur cURL : " . curl_error($ch);
            } else {
                // Traiter la réponse API
                $data = json_decode($response, true);

                // Vérifier si la réponse contient le texte généré
                if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                    echo htmlspecialchars($data['candidates'][0]['content']['parts'][0]['text']);
                } else {
                    echo "Erreur : Réponse inattendue de l'API.";
                }
            }
            curl_close($ch);
        } else {
            echo "Erreur : aucun texte fourni.";
        }
    } else {
        echo "Aucune description générée pour l'instant...";
    }
    ?>
  </div>

  <!-- Bouton retour -->
  <button class="back-button" onclick="window.location.href='dach.html';">Retour</button>

</body>
</html>
