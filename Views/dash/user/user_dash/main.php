<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: ../Views/front/sign/signin.php"); // Redirect if not logged in
    exit();
}

// Get session data
$username = $_SESSION["username"];
//$_SESSION["profile_picture"]='New folder\mvc\uploads\profile_pictures\profile.png';
$profile_picture =  $_SESSION["profile_picture"]; // Corrected path
 // Path to the profile picture
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


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
  <link rel="stylesheet" href="css/stylo.css">
  <title>Syncaura</title>
  <style>
/* Navbar Styles */
.site-nav {
  background: linear-gradient(to right, #1d3557, #457b9d);
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  position: fixed;
  top: 0;
  width: 100%;
  height:15%;
  z-index: 1000;
  font-family: 'Inter', sans-serif;
  opacity:80%;
}

/* Syncaura Logo */
.syncaura-logo {
  position: absolute;
  top: 5px; /* Moved further to the left */
  z-index: 1001; /* Ensures visibility above other elements */
  font-size: 1.5rem;
  color: #fff;
}

/* Profile Block */
.profile-block {
  background: linear-gradient(145deg, #007bff, #6a11cb); /* Smooth gradient */
  color: #fff;
  padding: 20px;
  border-radius: 16px;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.25), 0 4px 10px rgba(0, 0, 0, 0.2);
  position: fixed;
  top: 15px; /* Higher placement */
  right: 20px;
  z-index: 1100;
  display: flex;
  align-items: center;
  gap: 15px;
  transition: all 0.3s ease-in-out;
  overflow: hidden;
  width: 200px;
}

.profile-block:hover {
  transform: translateY(-10px); /* Hover lift effect */
  box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
  background: linear-gradient(145deg, #6a11cb, #007bff);
}

/* Profile Image */
.profile-block img {
  border-radius: 50%;
  width: 50px;
  height: 50px;
  object-fit: cover;
  border: 3px solid #fff;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

/* Profile Text */
.profile-block h2 {
  font-size: 18px;
  margin: 0;
  font-weight: 600;
}

.profile-block a {
  font-size: 14px;
  color: #ffd700;
  text-decoration: none;
  margin-top: 5px;
  font-weight: bold;
  transition: color 0.3s ease-in-out;
}

.profile-block a:hover {
  color: #fff;
  text-decoration: underline;
}

/* Controller Icon */
.controller-icon {
  position: fixed;
  bottom: 20px;
  right: 20px;
  z-index: 10;
  background-color: #007bff;
  border-radius: 50%;
  padding: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.controller-icon i {
  color: #fff;
  font-size: 24px;
}

.controller-icon:hover {
  transform: scale(1.1);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
}

  </style>

  <title>Learner Free Bootstrap Template by Untree.co</title>
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

  <nav class="site-nav">
  <div class="container position-relative">
    <div class="site-navigation">
      <a href="main.html" class="logo">SyncAura<span>.</span></a>
     
      <ul class="site-menu">
        <li><a href="../../../front/voice/loading.html">Create a  meet</a></li>
        <li><a href="../../../front/Ai/loding3.html">Ai ChatBot</a></li>
        <li><a href="../../../front/loading_screen/loading_p.html">Pomodoro Timer</a></li>
        <li><a href="../../../front/loading_screen/loadngg.php">buy a  Pack</a></li>
        <li><a href="../../../front/todolist/loading_todo.html">To Do List</a></li>
        <li><a href="../../../front/loading_screen/loading_support.html">Client support</a></li>
        <li><a href="../../../front/loading_screen/loadng.html">Chat</a></li>
        <li><a href="../../../front/sharefiles/loading.html">Share files</a></li>
        <li><a href="../../../front/loading_screen/laoding_modif.html">Modify Account</a></li>
        <li><a href="../../../front/loading_screen/loading_editor.html">Code Editor</a></li>
        <li><a href="../../../front/loading_screen/loading_thome.html">Blog</a></li>
        <li><a href="../../../front/coming_soon/loading.html">Whiteboard</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="profile-block">
                <img src="<?php echo $profile_picture; ?>" alt="Profile Picture">
                <h2>Welcome, <?php echo $username; ?>!</h2>
                <a href="../../../../Views/front/sign/signin.php">log out</a>
              </div>
  

  <div class="untree_co-hero overlay" style="background-image: url('images/hero-img-1-min.jpg');">

  <div class="controller-icon">
  <a href="../../../front/loading_screen/loading_game.html" title="Play Game">
    <i class="fas fa-gamepad"></i>
  </a>
</div>


<div class="container">
  <div class="row align-items-center justify-content-center">
    <!-- Welcome text section -->
  <div class="welcome-text-container">
  <h1 class="welcome-text" style="margin-left:100px">Welcome to SyncAura</h1>
  </div>




    <div class="col-12">

      <div class="row justify-content-center ">

        <div class="col-lg-6 text-center ">
          <h1 class="mb-4 heading text-white" data-aos="fade-up" data-aos-delay="100">Collaborez en Direct Réussissez Ensemble</h1>
          <p class="mb-0" data-aos="fade-up" data-aos-delay="300"><a href="#" class="btn btn-secondary">Crée une salle de project </a></p>

        </div>


      </div>

    </div>

  </div> <!-- /.row -->
</div> <!-- /.container -->

</div> <!-- /.untree_co-hero -->
<div class="spline-viewer">
  <spline-viewer url="https://prod.spline.design/BK83Flm76SwRJlHz/scene.splinecode"></spline-viewer>
</div>
<script>
  window.onload = function() {
      const shadowRoot = document.querySelector('spline-viewer').shadowRoot;
      if (shadowRoot) {
          const logo = shadowRoot.querySelector('#logo');
          if (logo) logo.remove();
      }
  }
</script>

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

<script src="main.js"></script>



</body>
</html>
