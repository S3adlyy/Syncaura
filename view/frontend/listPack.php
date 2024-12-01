<?php
// Enable error reporting for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the PackManager class to interact with the pack data
include 'C:\xampp1\htdocs\projetrayen\controller\packP.php';

// Create an instance of the PackManager to fetch all packs
$PackController = new PackController();
$packs = $PackController->listPacks(); // Fetch all packs data
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Packs</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="styleCard.css">
    <script src="https://unpkg.com/@splinetool/viewer/build/spline-viewer.js" type="module"></script>
    <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="imggg.png">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

  <link href="https://fonts.googleapis.com/css2?family=Display+Playfair:wght@400;700&family=Inter:wght@400;700&display=swap" rel="stylesheet">


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
  <link rel="stylesheet" href="css/stylo/css">
  <link rel="stylesheet" href="css/card.css">
</head>
<body>
<div class="site-mobile-menu">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close">
        <span class="icofont-close js-menu-toggle"></span>
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
  </div>

  <nav class="site-nav mb-5">
    <div class="pb-2 top-bar mb-3">
      <div class="container">
        <div class="row align-items-center">

          <div class="col-6 col-lg-9">
            <a href="listAchat.php" class="small mr-3"><span class="icon-question-circle-o mr-2"></span> <span class="d-none d-lg-inline-block"  >Consulter mes Achats</span></a> 
            <a href="#" class="small mr-3"><span class="icon-phone mr-2"></span> <span class="d-none d-lg-inline-block"  >+216 54171319</span></a> 
            <a href="./contact/loding2.php" class="small mr-3"><span class="icon-envelope mr-2"></span> <span class="d-none d-lg-inline-block" >Contact Us Via Email</span></a> 
          </div>
        </div>
      </div>
    </div>

    <div class="container position-relative">
        <div class="site-navigation text-center">
            <a href="main.html" class="logo menu-absolute m-0" align="left">SyncAura<span class="text-primary">.</span></a>
            <ul class="site-menu d-flex justify-content-center align-items-center">
                <li><a href="../front/createmeet/loadng2.php">Cree un meet</a></li>
                <li><a href="./Ai/loding3.php">Ai ChatBot</a></li>
                <li><a href="./promodor/index.php">Pomodoro Timer</a></li>
                <li><a href="loading_screen/loadng.php">Acheter un Pack</a></li>
                <li><a href="todo.php">To Do List</a></li>
                <li><a href="contact.php">Support Client</a></li>
                <li><a href="../loading_screen/loadng.html">Chat</a></li>
                <li><a href="./white/white.php">Whiteboard</a></li>
            </ul>
        </div>
    </div>
</nav>
  


<div class="spline-viewer">
    <spline-viewer url="https://prod.spline.design/O4wdVneKYyKKbJbX/scene.splinecode"></spline-viewer>
</div>

<div class="container">
    <div class="text-center">
        <h4>
        </h4>
    </div>

    <div class="packs-container">
        <?php foreach ($packs as $pack): ?>
            <div class="pack-card">
                <h2><?= htmlspecialchars($pack['nom']); ?></h2>
                <p><?= htmlspecialchars($pack['description']); ?></p>
                <p><strong>Prix: </strong><?= htmlspecialchars($pack['prix']); ?> td</p>

                <!-- Display the image if available -->
                <div class="pack-image">
                    <?php
                    $imageName = $PackController->getImageByIdPack($pack['id']);
                    if (!empty($imageName)) {
                        $imageArray = explode('/', $imageName);
                        $imageFileName = end($imageArray);
                        $imagePath = "http://localhost/projetrayen/view/backend/image_bdd/" . $imageFileName;
                        echo "<img src='$imagePath' alt='Image du pack'>";
                    } else {
                        echo "<p>Aucune image disponible</p>";
                    }
                    ?>
                </div>

                <!-- Update and Delete buttons -->
                <div class="pack-actions">
                 
                    <a href="commande.php?id=<?= $pack['id']; ?>" class="button-link">Commander</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<script>
    window.onload = function () {
        const shadowRoot = document.querySelector('spline-viewer').shadowRoot;
        if (shadowRoot) {
            const logo = shadowRoot.querySelector('#logo');
            if (logo) logo.remove();
        }
    }; </script>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/custom.js"></script>
    <script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.35/build/spline-viewer.js"></script>

    <script>
        window.onload = function() {
            const shadowRoot = document.querySelector('spline-viewer').shadowRoot;
            if (shadowRoot) {
                const logo = shadowRoot.querySelector('#logo');
                if (logo) logo.remove();
            }
        }
    </script>
</script>
</body>
</html>