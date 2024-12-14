<?php

include '../config.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include '../models/like_post.php';

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

    <link rel="stylesheet" href="../views/front/css/bootstrap.min.css">
    <link rel="stylesheet" href="../views/front/css/animate.min.css">
    <link rel="stylesheet" href="../views/front/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../views/front/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="flaticon.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="../views/front/css/aos.css">
    <link rel="stylesheet" href="../views/front/css/style.css">
    <link rel="stylesheet" href="../views/front/css/styleo.css">
    <link rel="stylesheet" href="../views/front/css/stylo.css">
    <link rel="stylesheet" href="../views/front/css/author.css">

</head>
<body>
   
<nav class="site-nav mb-5 sticky-nav">
        <div class="container position-relative">
            <div class="site-navigation text-center">
                <a href="../views/front/main.html" class="logo menu-absolute m-0" align="left">SyncAura<span class="text-primary">.</span></a>
                <ul class="site-menu d-flex justify-content-center align-items-center">
                <li><a href="../Views/front/loading_screen/loading_meet.html">Cree un meet</a></li>
                    <li><a href="../Views/front/Ai/loding3.html">Ai ChatBot</a></li>
                    <li><a href="../Views/front/loading_screen/loading_p.html">Pomodoro Timer</a></li>
                    <li><a href="../Views/front/loading_screen/loadngg.php">Acheter un Pack</a></li>
                    <li><a href="todo.php">To Do List</a></li>
                    <li><a href="contact.php">Support Client</a></li>
                    <li><a href="../Views/front/loading_screen/loadng.html">Chat</a></li>
                    <li><a href="../Views/front/loading_screen/loading_share.html">Share files</a></li>
                    <li><a href="../Views/front/loading_screen/loading_editor.html">Code Editor</a></li>
                    <li><a href="../Views/front/thome.php">blog</a></li>
                </ul>
            </div>
        </div>
    </nav>




<section class="authors">

   <h1 class="heading" style="color:white">authors</h1>

   <div class="box-container">

   <?php
      $select_author = $conn->prepare("SELECT * FROM `admin`");
      $select_author->execute();
      if($select_author->rowCount() > 0){
         while($fetch_authors = $select_author->fetch(PDO::FETCH_ASSOC)){ 

            $count_admin_posts = $conn->prepare("SELECT * FROM `posts` WHERE admin_id = ? AND status = ?");
            $count_admin_posts->execute([$fetch_authors['id'], 'active']);
            $total_admin_posts = $count_admin_posts->rowCount();

            $count_admin_likes = $conn->prepare("SELECT * FROM `likes` WHERE admin_id = ?");
            $count_admin_likes->execute([$fetch_authors['id']]);
            $total_admin_likes = $count_admin_likes->rowCount();

            $count_admin_comments = $conn->prepare("SELECT * FROM `comments` WHERE admin_id = ?");
            $count_admin_comments->execute([$fetch_authors['id']]);
            $total_admin_comments = $count_admin_comments->rowCount();

   ?>
   <div class="box">
      <p>author : <span><?= $fetch_authors['name']; ?></span></p>
      <p>total posts : <span><?= $total_admin_posts; ?></span></p>
      <p>posts likes : <span><?= $total_admin_likes; ?></span></p>
      <p>posts comments : <span><?= $total_admin_comments; ?></span></p>
      <a href="author_posts.php?author=<?= $fetch_authors['name']; ?>" class="btn">view posts</a>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">no authors found</p>';
   }
   ?>

   </div>
      
</section>

<div class="spline-viewer">
<spline-viewer url="https://prod.spline.design/BK83Flm76SwRJlHz/scene.splinecode"></spline-viewer>
        
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