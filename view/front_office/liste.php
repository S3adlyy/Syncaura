<?php
include 'C:/xampp/htdocs/Forum/controller/questionsC.php';
include 'C:/xampp/htdocs/Forum/config.php'; 
include 'C:/xampp/htdocs/Forum/Model/questions.php';

// Initialize the controller
$questionsC = new questionsC();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Check if 'type' is set in POST
    if (isset($_POST['type']) && !empty($_POST['type'])) {
        // Create the question object
        $question = new questions(
            null, // ID is auto-incremented
            $_POST['questions'], // The question text
            new DateTime($_POST['date_creation']), // Creation date
            $_POST['id'], // User ID
            $_POST['type'],// The type selected
        );

        // Call the addquestion method
        $questionsC->addquestion($question);

        // Confirmation message
        echo "<p>Question added successfully!</p>";
    } else {
        echo "<p>Please select a type for the question.</p>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <title>EduWell - Education HTML5 Template</title>
      <link rel="stylesheet" href="style.css">

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-eduwell-style.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">

    <script src="controlle.js"></script>
<!--

TemplateMo 573 EduWell

https://templatemo.com/tm-573-eduwell

-->
  </head>

<body>


  
  <!--<header class="header-area header-sticky">
      <div class="container">
          <div class="row">
              <div class="col-12">
                <nav class="main-nav">
                 
                  <a href="index.php" class="logo">
                      <img src="assets/images/templatemo-eduwell.png" alt="EduWell Template">
                  </a>
                  
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
                  
                </nav>
              </div>
          </div>
      </div>
  </header>-->

<div class ="container">
  <div class="section-heading">
    
          <h4>Forum</h4>
          
          
        </div>
        <div class="col-lg-6">
          <h6>Have any questions? We're here to help – just ask!</h6>
          <br>



     <form method="POST" action="">
     <div class="mb-3">
            <label for="type" class="form-label">Type of question :</label>
            <select class="form-select" id="type" name="type" >
                <option value="" hidden>Choose a type</option>
                <option value="General question">Question générale</option>
                <option value="Homework Help">Homework Help</option>
                <option value="Scientific question">Scientifc question</option>
                <option value="Computer science">Computer_science</option>
                <option value="History/Geography">History/Geography</option>
                <option value="Other">Other</option>
            </select>
        </div>





        <div class="mb-3">
            <label for="questions" class="form-label">Question :</label>
            <input type="text" class="form-control" id="questions" name="questions">
        </div>

      
        <div class="mb-3">
            <label for="date_creation" class="form-label">Date de création :</label>
            <input type="datetime-local" class="form-control" id="date_creation" name="date_creation">
        </div>

        <div class="mb-3">
          
            <label for="id" class="form-label">ID de l'utilisateur :</label>
            <input type="number" class="form-control" id="id" name="id" value="1">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Add Question </button>
        <a class="btn btn-primary" href="updatequestion.php" role="bouton"> Update Question </a>

        

    
    </form>


<br>
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
            $('body, html').animate({
              scrollTop: reqSectionPos },
            800);
          } else {
            $('body, html').scrollTop(reqSectionPos);
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
</html>