<?php
// Inclure les fichiers nécessaires une seule fois
include_once "../../../configg.php";
include_once "../../../models/Reponse.php";
include_once "../../../controller/reponseC.php";
include_once "../../../controller/questionsC.php";


// Instancier le contrôleur de réponses
$repC = new reponseC();

// Récupérer les réponses
$rep = $repC->listReponse();

// Instancier le contrôleur de questions
$questionsC = new questionsC();  // Vous pouvez maintenant instancier correctement questionsC

// Récupérer les questions
$questions = $questionsC->listquestion();
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
  <title>Support client </title>
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

        .card-container {
            position: relative;
            z-index: 2;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding: 30px;
        }

        .card {
            width: 320px;
            background: linear-gradient(145deg, #4f80ff, #346db8);
            color: white;
            border-radius: 20px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
            padding: 20px;
            margin: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
            text-align: center;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.5);
        }

        .card-header {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .card-body p {
            margin: 10px 0;
            font-size: 1rem;
            line-height: 1.5;
        }

        .card-footer {
            margin-top: 20px;
        }

        .button1 {
            display: inline-block;
            background-color: #ff5722;
            color: white;
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .button1:hover {
            background-color: #e64a19;
            transform: scale(1.1);
        }

        .cool-button {
            background: linear-gradient(145deg, #00c6ff, #0072ff);
            color: white;
            border: none;
            border-radius: 30px;
            padding: 12px 24px;
            font-size: 1.2rem;
            font-weight: bold;
            text-transform: uppercase;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            margin-top: 30px;
            transition: transform 0.2s ease, box-shadow 0.3s ease;
        }

        .cool-button:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .cool-link {
            text-decoration: none;
        }

    </style>
</head>
<body>
<nav class="site-nav mb-5 sticky-nav">
    <div class="container position-relative">
        <div class="site-navigation text-center">
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
<div class="card-container">
    <!-- Affichage des questions sous forme de cartes -->
    <?php
    foreach ($questions as $question) {
        echo '<div class="card">';
        echo '<div class="card-header">' . htmlspecialchars($question['questions']) . '</div>';
        echo '<div class="card-body">';
        echo '<p><strong>ID Question:</strong> ' . htmlspecialchars($question['id_question']) . '</p>';
        echo '<p><strong>Date de création:</strong> ' . htmlspecialchars($question['date_creation']) . '</p>';
        echo '<p><strong>Type:</strong> ' . htmlspecialchars($question['type']) . '</p>';
        echo '</div>';
        echo '<div class="card-footer">';
        echo '<button class="button1 edit" onclick="window.location.href = \'modifierQuestion.php?id=' . $question['id_question'] . '\';"><i class="fa fa-edit"></i> Modifier</button>';
        echo '<button class="button1 delete" onclick="window.location.href = \'suppressionQuestion.php?id=' . $question['id_question'] . '\';"><i class="fa fa-trash"></i> Supprimer</button>';
       
        echo '</div>';
        echo '</div>';
    }
    ?>
</div>

<div class="card-container">
    <!-- Affichage des réponses sous forme de cartes -->
    <?php
    foreach ($rep as $reponse) {
        echo '<div class="card">';
        echo '<div class="card-header">Réponse - ' . htmlspecialchars($reponse['id_reponse']) . '</div>';
        echo '<div class="card-body">';
        echo '<p><strong>Contenu de la réponse:</strong> ' . htmlspecialchars($reponse['contenu_reponse']) . '</p>';
        echo '<p><strong>Date de la réponse:</strong> ' . htmlspecialchars($reponse['date_reponse']) . '</p>';
        echo '<p><strong>Question concernée:</strong> ' . htmlspecialchars($reponse['contenu_question']) . '</p>';
        echo '</div>';
        echo '<div class="card-footer">';
       
       
        echo '</div>';
        echo '</div>';
    }
    ?>
    <a href="forum_ajoutquestion.php" class="cool-link">
  <button class="cool-button">Ajouter Question</button>
    </a>
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
