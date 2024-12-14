<?php
ob_start();
include 'myplans.php';
$myPlansContent = ob_get_clean();
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
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
  <link rel="stylesheet" href="main/css/bootstrap.min.css">
  <link rel="stylesheet" href="main/css/animate.min.css">
  <link rel="stylesheet" href="main/css/owl.carousel.min.css">
  <link rel="stylesheet" href="main/css/owl.theme.default.min.css">
  <link rel="stylesheet" href="flaticon.css">
  <link rel="stylesheet" href="main/style.css">
  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
  <link rel="stylesheet" href="main/css/aos.css">
  <link rel="stylesheet" href="main/css/style.css">
  <link rel="stylesheet" href="main/css/stylo.css">
  <style>
html, body {
  margin: 0;
  padding: 0;
  height: 100%;
  font-family: Arial, sans-serif;
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden; /* Prevent body scrolling */
}

.spline-viewer {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100vh;
  z-index: 1;
}

.content-container {
  position: fixed;
  z-index: 2; 
  background: rgba(255, 255, 255, 0.7); 
  width: 70%; 
  height: 80%; 
  padding: 20px;
  border-radius: 15px; 
  box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15); 
  overflow-y: auto; 
  display: flex;
  flex-direction: column;
  justify-content: flex-start; 
  text-align: left; 
}

  </style>

  <title>To-Do List</title>
</head>

<body>
  <nav class="site-nav mb-5 sticky-nav">
    <div class="container position-relative">
        <div class="site-navigation text-center">
            <a href="../../dash/user/user_dash/main.php" class="logo menu-absolute m-0" align="left">SyncAura<span class="text-primary"></span></a>
            <ul class="site-menu d-flex justify-content-center align-items-center">
            <li><a href="../loading_screen/loading_meet.html">Create a meet</a></li>
                <li><a href="../Ai/loding3.html">Ai ChatBot</a></li>
                <li><a href="../loading_screen/loading_p.html">Pomodoro Timer</a></li>
                <li><a href="../loading_screen/loadngg.php">buy a  Pack</a></li>
                <li><a href="todolist.php">To Do List</a></li>
                <li><a href="../loading_screen/loading_support.html">Client support </a></li>
                <li><a href="../loading_screen/loadng.html">Chat</a></li>
                <li><a href="../loading_screen/loading_share.html">Share files</a></li>
                <li><a href="../loading_screen/laoding_modif.html">Modify Account</a></li>
                <li><a href="../loading_screen/loading_editor.html">Code Editor</a></li>
                <li><a href="../loading_screen/loading_thome.html">Blog</a></li>
            </ul>
        </div>
    </div>
  </nav>

  <div class="untree_co-hero overlay" style="background-image: url('images/hero-img-1-min.jpg');">
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <!-- Welcome text section -->
        <div class="welcome-text-container">
         
        </div>
      </div>
    </div>
  </div>

  <br><br>

  <div class="content-container">
    <!-- Render the My Plans content here -->
    <?php echo $myPlansContent; ?>
  </div>

  
  <div class="spline-viewer">
  <spline-viewer url="https://prod.spline.design/BK83Flm76SwRJlHz/scene.splinecode"></spline-viewer>
  </div>

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
</body>
</html>
