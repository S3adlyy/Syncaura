<?php

include '../config.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'like_post.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="imggg.png">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />

    <link href="https://fonts.googleapis.com/css2?family=Display+Playfair:wght@400;700&family=Inter:wght@400;700&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <link rel="stylesheet" href="../view/frontoffice/css/bootstrap.min.css">
    <link rel="stylesheet" href="../view/frontoffice/css/animate.min.css">
    <link rel="stylesheet" href="../view/frontoffice/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../view/frontoffice/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="flaticon.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="../view/frontoffice/css/aos.css">
    <link rel="stylesheet" href="../view/frontoffice/css/style.css">
    <link rel="stylesheet" href="../view/frontoffice/css/styleo.css">
    <link rel="stylesheet" href="../view/frontoffice/css/stylo.css">
    <link rel="stylesheet" href="../view/frontoffice/css/catg.css">

</head>
<body>
<nav class="site-nav mb-5 sticky-nav">
        <div class="container position-relative">
            <div class="site-navigation text-center">
                <a href="../view/frontoffice/main.html" class="logo menu-absolute m-0" align="left">SyncAura<span class="text-primary">.</span></a>
                <ul class="site-menu d-flex justify-content-center align-items-center">
                    <li><a href="../front/createmeet/loadng2.php">Cree un meet</a></li>
                    <li><a href="./Ai/loding3.php">Ai ChatBot</a></li>
                    <li><a href="./promodor/index.php">Pomodoro Timer</a></li>
                    <li><a href="">Acheter un Pack</a></li>
                    <li><a href="todo.php">To Do List</a></li>
                    <li><a href="contact.php">Support Client</a></li>
                    <li><a href="index.html">Chat</a></li>
                    <li><a href="./white/white.php">Whiteboard</a></li>
                    <li><a href="../view/frontoffice/thome.php">blog</a></li>

                </ul>
            </div>
        </div>
    </nav>

<section class="categories">

   <h1 class="heading">post categories</h1>

   <div class="box-container">
      <div class="box"><span>01</span><a href="category.php?category=nature">nature</a></div>
      <div class="box"><span>02</span><a href="category.php?category=eduction">education</a></div>
      <div class="box"><span>03</span><a href="category.php?category=technology">technology</a></div>
      <div class="box"><span>04</span><a href="category.php?category=entertainment">entertainment</a></div>
      <div class="box"><span>05</span><a href="category.php?category=gaming">gaming</a></div>
      <div class="box"><span>06</span><a href="category.php?category=news">news</a></div>
      <div class="box"><span>07</span><a href="category.php?category=design and development">design and development</a></div>
      <div class="box"><span>08</span><a href="category.php?category=business">business</a></div>
   </div>

</section>










<div class="spline-viewer">
        <spline-viewer url="https://prod.spline.design/O4wdVneKYyKKbJbX/scene.splinecode"></spline-viewer>
      </div>
<script src="../assets/js/script.js"></script>
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