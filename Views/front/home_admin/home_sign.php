<!doctype html>
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
  <link rel="stylesheet" href="css/animate.min.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="flaticon.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
  <link rel="stylesheet" href="css/aos.css">
  <link rel="stylesheet" href="css/style.css">

  <style>
    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: Arial, sans-serif;
      overflow: hidden;
    }

    /* Center button styles */
    .button-container {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      text-align: center;
      z-index: 10;
    }

    .button-container .btn {
      margin: 10px;
      padding: 15px 30px;
      font-size: 18px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s, transform 0.3s;
    }

    .button-container .btn:hover {
      background-color: #0056b3;
      transform: scale(1.05);
    }

    .spline-viewer {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100vh;
      z-index: 1;
    }

    /* Navbar styling */
    .nav-item {
      margin-left: 15px;
    }

    .nav-item a {
      text-decoration: none;
      color: black;
      transition: color 0.3s;
    }

    .nav-item a:hover {
      color: #007bff;
    }

    /* Hidden admin button */
    .admin-btn {
      display: none;
    }
  </style>

  <title>Learner Free Bootstrap Template by Untree.co</title>
</head>

<body>
  
  <!-- Navigation Bar -->
  <nav class="site-nav mb-5">
    <div class="sticky-nav js-sticky-header">
      <div class="container position-relative">
        <div class="site-navigation d-flex justify-content-between align-items-center">
          <a href="index.html" class="logo menu-absolute m-0">SyncAura<span class="text-primary">.</span></a>
          <ul class="js-clone-nav d-lg-inline-block site-menu d-flex align-items-center">
            <li class="nav-item"><a href="index.html">Home</a></li>
            <li class="nav-item"><a href="about.html">About Us</a></li>
            <li class="nav-item"><a href="contact.html">Contact</a></li>
          </ul>
          <a href="#" class="burger ml-auto float-right site-menu-toggle js-menu-toggle d-inline-block d-lg-none light">
            <span></span>
          </a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <div class="untree_co-hero overlay" style="background-image: url('images/hero-img-1-min.jpg');">
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="col-12">
          <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
              <h1 class="mb-4 heading text-white" data-aos="fade-up" data-aos-delay="100">Collaborez en Direct Réussissez Ensemble</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Center Buttons -->
  <div class="button-container">
    <button class="btn" onclick="window.location.href='../sign/signin.php';">Sign In</button>
    <button class="btn" onclick="window.location.href='../sign/signup.php';">Sign Up</button>
    <!-- Admin button, initially hidden -->
    <button class="btn admin-btn" onclick="window.location.href='../sign/admin/signin.php';">Admin Home</button>
  </div>

  <div class="spline-viewer">
    <spline-viewer url="https://prod.spline.design/O4wdVneKYyKKbJbX/scene.splinecode"></spline-viewer>
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

        // Prompt for code and show admin button if the correct code is entered
        const code = prompt("Enter the admin code:");
        const adminBtn = document.querySelector('.admin-btn');
        if (code === "adminadmin") {
            adminBtn.style.display = 'inline-block'; // Show the admin button
        }
    }
  </script>

</body>
</html>
