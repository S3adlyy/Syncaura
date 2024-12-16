<?php
// Inclure les fichiers nécessaires pour la gestion des achats
include 'C:\xampp\htdocs\integration3\controller\achatA.php';

// Instancier l'objet AchatManager pour récupérer les achats avec l'image du pack
$achatManager = new AchatManager();
$achats = $achatManager->showAchatWithImage(); // Récupérer les achats avec le pack et l'image

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="imgggg.png">
  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

  <link href="https://fonts.googleapis.com/css2?family=Display+Playfair:wght@400;700&family=Inter:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <style>
    /* General styles */
    body {
      font-family: 'Inter', sans-serif;
      margin: 0;
      overflow: hidden;
    }

    /* Spline viewer as the background */
    .spline-viewer {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
    }

    /* Foreground content styles */
    .container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      padding: 20px;
      z-index: 2;
      position: relative;
    }

    .card {
      margin: 15px;
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 15px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent background */
    }

    .card img {
      max-width: 100%;
      height: auto;
      border-radius: 8px;
    }

    .card-body {
      text-align: center;
    }

    .btn {
      margin-top: 10px;
      width: 100%;
    }

    .card-title {
      font-size: 1.2rem;
      font-weight: bold;
    }

    .card-text {
      color: #555;
    }

    .actions a {
      color: #007bff;
      text-decoration: none;
      margin: 0 5px;
    }

    .actions a:hover {
      text-decoration: underline;
    }

    .text-center {
      z-index: 2;
      position: relative;
    }
  </style>
</head>
<body>
  <div class="spline-viewer ">
  <spline-viewer url="https://prod.spline.design/UUgna2upZYWedWKa/scene.splinecode"></spline-viewer>
  </div>
  <!-- Lien pour ajouter un nouvel achat -->
  <div class="text-center my-4">
    <a href="listPack.php" class="btn btn-primary">Buy !</a>
  </div>

  <!-- Affichage des achats sous forme de cartes -->
  <div class="container">
    <?php
    // Afficher chaque achat sous forme de carte
    foreach ($achats as $achat) {
        echo '<div class="card" style="width: 18rem;">';
        // Affichage de l'image du pack
        echo '<div class="card-body">';
        echo '<h5 class="card-title">purchase' . $achat['ida'] . '</h5>';
        echo '<p class="card-text">username: ' . $achat['nom_user'] . '</p>';
        echo '<p class="card-text">Email: ' . $achat['email'] . '</p>';
        echo '<p class="card-text">Pack: ' . $achat['pack_nom'] . '</p>';
        echo '<div class="actions">';
        echo '<a href="editAchat.php?id=' . $achat['ida'] . '" class="btn btn-outline-primary">modify</a>';
        echo '</div>';
        echo '<a href="deleteAchat.php?id=' . $achat['ida'] . '" class="btn btn-outline-danger">delete</a>';
        echo '</div>';
        echo '</div>';
        
    }
    ?>
  </div>

  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
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


