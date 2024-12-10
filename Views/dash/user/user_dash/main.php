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

    .spline-viewer {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100vh;
      z-index: 1; /* Ensure the viewer is behind the form */
    }

    a {
      color: #007bff; /* Initial color for links */
      text-decoration: none; /* Remove underline */
      font-weight: 500; /* Slightly bolder text */
      transition: color 0.2s; /* Smooth color transition */
    }

    /* Simple hover effect */
    a:hover {
      color: #007bff; /* Change to a blue shade on hover */
    }

    /* Minimal padding for a bit of spacing */
    .site-nav a {
      padding: 5px 8px;
    }

    /* Optional: underline only on hover for subtle emphasis */
    a:hover {
      text-decoration: underline;
    }

    /* Profile block styles */
    .profile-block {

      background-color: #fff;
      padding: 10px;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 10;
    }

    .profile-block img {
    border-radius: 50%;          /* Ensures the image is circular */
    width: 30px;                 /* Fixed width */
    height: 30px;                /* Fixed height */
    object-fit: cover;           /* Ensures the image covers the area without distortion */
    object-position: center;     /* Centers the image inside the circular area */
}


    .profile-block h2 {
      font-size: 16px;
      margin: 0;
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

    <nav class="site-nav mb-5 sticky-nav">
    <div class="container position-relative">
        <div class="site-navigation text-center">
            <a href="main.html" class="logo menu-absolute m-0" align="left">SyncAura<span class="text-primary">.</span></a>
            <ul class="site-menu d-flex justify-content-center align-items-center">
                <li><a href="../../../front/loading_screen/loading_meet.html">Cree un meet</a></li>
                <li><a href="../../../front/Ai/loding3.html">Ai ChatBot</a></li>
                <li><a href="../../../front/loading_screen/loading_p.html">Pomodoro Timer</a></li>
                <li><a href="../../../front/loading_screen/loadngg.php">Acheter un Pack</a></li>
                <li><a href="../../../front/todolist/loading_todo.html">To Do List</a></li>
                <li><a href="#">Support Client</a></li>
                <li><a href="../../../front/loading_screen/loadng.html">Chat</a></li>
                <li><a href="../../../front/loading_screen/loading_share.html">Share files</a></li>
                <li><a href="../../../front/loading_screen/laoding_modif.html">Modify Account</a></li>
                <li><a href="../../../front/loading_screen/loading_editor.html">Code Editor</a></li>
                <li><a href="../../../front/loading_screen/loading_thome.html">Blog</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="profile-block">
                <img src="<?php echo $profile_picture; ?>" alt="Profile Picture">
                <h2>Welcome, <?php echo $username; ?>!</h2>
                <a href="../../../../Views/front/sign/signin.php">log out </a>
              </div>
  

  <div class="untree_co-hero overlay" style="background-image: url('images/hero-img-1-min.jpg');">


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
  <spline-viewer url="https://prod.spline.design/O4wdVneKYyKKbJbX/scene.splinecode"></spline-viewer>
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
