<?php

include 'C:/xampp/htdocs/Forum/config.php'; // Inclure la configuration de connexion à la base de données
include 'C:/xampp/htdocs/Forum/controller/questionsC.php';
?>


<!DOCTYPE php>
<php lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <title>EduWell - Education php5 Template</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-eduwell-style.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
<!--

TemplateMo 573 EduWell

https://templatemo.com/tm-573-eduwell

-->
  </head>

<body>

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
      <div class="container">
          <div class="row">
              <div class="col-12">
                <nav class="main-nav">
                  <!-- ***** Logo Start ***** -->
                  <a href="index.php" class="logo">
                      <img src="assets/images/templatemo-eduwell.png" alt="EduWell Template">
                  </a>
                  <!-- ***** Logo End ***** -->
                  <!-- ***** Menu Start ***** -->
                  <ul class="nav">
                    <li><a href="index.php" class="active">Home</a></li>
                    <li><a href="index.php">Teachers</a></li>
                    <li><a href="index.php">Courses</a></li>
                    <li class="has-sub">
                        <a href="javascript:void(0)">Pages</a>
                        <ul class="sub-menu">
                            <li><a href="about-us.php">About Us</a></li>
                            <li><a href="Forum.php">Forum</a></li>
                            <li><a href="contact-us.php">Sign up</a></li>
                        </ul>
                    </li>
                    <li><a href="index.php">Donate</a></li> 
                    <li><a href="index.php">Contact Us</a></li> 
                  </ul>     
                  <a class='menu-trigger'>
                      <span>Menu</span>
                  </a>
                  <!-- ***** Menu End ***** -->
                </nav>
              </div>
          </div>
      </div>
  </header>
  <!-- ***** Header Area End ***** -->

  <section class="page-heading">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="header-text">
            <h1>List Of Forum</h1>
            <table style="margin-left: 300px;">
            <thead>
            <tr>
                <th>titre</th>
                <th>description</th>
                <th>Date_Creation</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
          </thead>
          <tbody>
        </div>
        </div>
      </div>
    </div>
  </section>

  <section class="services">
    <div class="container">
      <div class="row">
        
        <div class="col-lg-12">
          <div class="owl-service-item owl-carousel">
            <div class="item">
              <div class="service-item">
                <div class="icon">
                  <img src="assets/images/service-icon-01.png" alt="">
                </div>
                <h4>General Question</h4>
                <a class="btn btn-primary" href="liste.php" role="bouton"> send </a>
              </div>
            </div>
            <div class="item">
              <div class="service-item">
                <div class="icon">
                  <img src="assets/images/service-icon-02.png" alt="">
                </div>
                <h4>Homework Help</h4>
                <a class="btn btn-primary" href="liste.php" role="bouton"> send </a>

              </div>
            </div>
            <div class="item">
              <div class="service-item">
                <div class="icon">
                  <img src="assets/images/service-icon-03.png" alt="">
                </div>
                <h4>Scientific Question</h4>
                <a class="btn btn-primary" href="liste.php" role="bouton"> send </a>
              </div>
            </div>
            <div class="item">
              <div class="service-item">
                <div class="icon">
                  <img src="assets/images/service-icon-04.png" alt="">
                </div>
                <h4>Computer_Science Question</h4>
                <a class="btn btn-primary" href="liste.php" role="bouton"> send </a>
              </div>
            </div>
            <div class="item">
              <div class="service-item">
                <div class="icon">
                  <img src="assets/images/service-icon-05.png" alt="">
                </div>
                <h4>History Or Geography Question</h4>
                <a class="btn btn-primary" href="liste.php" role="bouton"> send </a>
                
              </div>
            </div>
            <div class="item">
              <div class="service-item">
                <div class="icon">
                  <img src="assets/images/service-icon-06.png" alt="">
                </div>
                <h4>Other Question</h4>
                <a class="btn btn-primary" href="liste.php" role="bouton"> send </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>










  

<!-- Scripts -->
<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="assets/js/isotope.min.js"></script>
<script src="assets/js/owl-carousel.js"></script>
<script src="assets/js/lightbox.js"></script>
<script src="assets/js/tabs.js"></script>
<script src="assets/js/video.js"></script>
<script src="assets/js/slick-slider.js"></script>
<script src="assets/js/custom.js"></script>
<script>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/video.js"></script>
    <script src="assets/js/slick-slider.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>
        //according to loftblog tut
        $('.nav li:first').addClass('active');

        var showSection = function showSection(section, isAnimate) {
          var
          direction = section.replace(/#/, ''),
          reqSection = $('.section').filter('[data-section="' + direction + '"]'),
          reqSectionPos = reqSection.offset().top - 0;

          if (isAnimate) {
            $('body, php').animate({
              scrollTop: reqSectionPos },
            800);
          } else {
            $('body, php').scrollTop(reqSectionPos);
          }

        };

        var checkSection = function checkSection() {
          $('.section').each(function () {
            var
            $this = $(this),
            topEdge = $this.offset().top - 80,
            bottomEdge = topEdge + $this.height(),
            wScroll = $(window).scrollTop();
            if (topEdge < wScroll && bottomEdge > wScroll) {
              var
              currentId = $this.data('section'),
              reqLink = $('a').filter('[href*=\\#' + currentId + ']');
              reqLink.closest('li').addClass('active').
              siblings().removeClass('active');
            }
          });
        };

        $('.main-menu, .responsive-menu, .scroll-to-section').on('click', 'a', function (e) {
          e.preventDefault();
          showSection($(this).attr('href'), true);
        });

        $(window).scroll(function () {
          checkSection();
        });
    </script>
</body>
</php>
