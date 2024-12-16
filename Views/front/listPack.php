<?php
// Enable error reporting for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the PackManager class to interact with the pack data
include 'C:\xampp\htdocs\integration3\controller\packP.php';

// Create an instance of the PackManager to fetch all packs
$PackController = new PackController();
$packs = $PackController->listPacks(); // Fetch all packs data
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>packs manager</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="styleCard.css">
    <script src="https://unpkg.com/@splinetool/viewer/build/spline-viewer.js" type="module"></script>
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="imgggg.png">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

  <link href="https://fonts.googleapis.com/css2?family=Display+Playfair:wght@400;700&family=Inter:wght@400;700&display=swap" rel="stylesheet">


  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

  <link rel="stylesheet" href="main/css/bootstrap.min.css">
  <link rel="stylesheet" href="main/css/animate.min.css">
  <link rel="stylesheet" href="main/css/owl.carousel.min.css">
  <link rel="stylesheet" href="main/css/owl.theme.default.min.css">
  <link rel="stylesheet" href="flaticon.css">
  <link rel="stylesheet" href="main/style.css">
  <link rel="stylesheet" href="../fonts/flaticon/font/flaticon.css">
  <link rel="stylesheet" href="main/css/aos.css">
  <link rel="stylesheet" href="main/css/style.css">
  <link rel="stylesheet" href="main/css/stylo.css">
  <style>
    .packs-container {
    position: relative; /* Ensures it is positioned over the background */
    z-index: 10; /* Higher than the Spline viewer */
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px; /* Adds spacing between cards */
    margin-top: 50px; /* Adjust as needed */
    padding: 20px;
    background-color: rgba(255, 255, 255, 0.8); /* Slight background to improve readability */
    border-radius: 15px; /* Rounded corners for modern design */
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    transition: box-shadow 0.3s ease-in-out; /* Smooth shadow transition */
}

.pack-card {
    position: relative;
    z-index: 11; /* Ensures cards are individually above the container */
    width: 300px; /* Larger card width for better visibility */
    padding: 15px;
    background-color: #fff; /* White background for clarity */
    border: 1px solid #ddd;
    border-radius: 10px; /* Rounded corners */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease-in-out;
}

.pack-card img {
    max-width: 100%;
    border-radius: 10px; /* Rounded corners on images */
}

.pack-card:hover {
    transform: translateY(-5px); /* Hover effect for better UI */
    box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2); /* Increase shadow effect on hover */
}

.button-link {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: bold;
    color: #fff;
    background: linear-gradient(90deg, #007bff, #00aaff); /* Blue-to-white gradient */
    border-radius: 8px; /* Rounded corners */
    border: none;
    cursor: pointer;
    text-align: center;
    transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease-in-out;
    text-decoration: none;
}

.button-link:hover {
    background: linear-gradient(90deg, #00aaff, #007bff); /* Reverse gradient on hover */
    transform: translateY(-3px); /* Elevate slightly for a pressed effect */
    box-shadow: 0 10px 15px rgba(0, 0, 0, 0.3); /* Add shadow for depth */
}
  </style>
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
            <a href="listAchat.php" class="small mr-3"><span class="icon-question-circle-o mr-2"></span> <span class="d-none d-lg-inline-block"  >View my purchases</span></a> 
            <a href="des.php" class="small mr-3"><span class="icon-envelope mr-2"></span> <span class="d-none d-lg-inline-block" >help in choice of package</span></a> 
          </div>
        </div>
      </div>
    </div>

    <div class="container position-relative">
        <div class="site-navigation text-center">
            
            <ul class="site-menu d-flex justify-content-center align-items-center">
            <li><a href="loading_screen/loading_p.html">Pomodoro Timer</a></li>
            <li><a href="Ai/loding3.html">Ai ChatBot</a></li>
            <li><a href="loading_screen/loadngg.php">buy a pack</a></li>
            <li><a href="todolist/loading_todo.html">To Do List</a></li>
            <li><a href="loading_screen/loading_support.html">Client support</a></li>
            <li><a href="loading_screen/loadng.html">Chat</a></li>
            <li><a href="loading_screen/loading_editor.html">Code Editor</a></li>
            <li><a href="loading_screen/loading_share.html">Share files</a></li>
            <li><a href="loading_screen/laoding_modif.html">Modify Account</a></li>
            <li><a href="loading_screen/loading_meet.html">Meeting</a></li>
            <li><a href="loading_screen/loading_thome.html">blog</a></li>
            <li><a href="media/media.html">social media</a></li>
            <li><a href="coming_soon/loading.html">Whiteboard</a></li>
            </ul>
        </div>
    </div>
</nav>
  


<div class="spline-viewer">
<spline-viewer url="https://prod.spline.design/BK83Flm76SwRJlHz/scene.splinecode"></spline-viewer>
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
                <p><strong>Price: </strong><?= htmlspecialchars($pack['prix']); ?> td</p>

                <!-- Display the image if available -->
                <div class="pack-image">
                    <?php
                    $imageName = $PackController->getImageByIdPack($pack['id']);
                    if (!empty($imageName)) {
                        $imageArray = explode('/', $imageName);
                        $imageFileName = end($imageArray);
                        $imagePath = "http://localhost/integration3/Views/dash/image_bdd/" . $imageFileName;
                        echo "<img src='$imagePath' alt='pack image'>";
                    } else {
                        echo "<p>Aucune image disponible</p>";
                    }
                    ?>
                </div>

                <!-- Update and Delete buttons -->
                <div class="pack-actions">
                 
                    <a href="commande.php?id=<?= $pack['id']; ?>" class="button-link">Command</a>
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
