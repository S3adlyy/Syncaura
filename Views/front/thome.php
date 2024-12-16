<?php

include '../../config.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include '../../models/like_post.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>blog</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="imgggg.png">

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
    <link rel="stylesheet" href="css/styleo.css">
    <link rel="stylesheet" href="css/stylo.css">
    <link rel="stylesheet" href="css/box.css">
</head>
<body>
    <nav class="site-nav mb-5 sticky-nav">
        <div class="container position-relative">
            <div class="site-navigation text-center">
                <ul class="site-menu d-flex justify-content-center align-items-center">
                    <li><a href="loading_screen/loading_meet.html">Cree un meet</a></li>
                    <li><a href="Ai/loding3.html">Ai ChatBot</a></li>
                    <li><a href="loading_screen/loading_p.html">Pomodoro Timer</a></li>
                    <li><a href="loading_screen/loadngg.php">Acheter un Pack</a></li>
                    <li><a href="todolist/loading_todo.html">To Do List</a></li>
                    <li><a href="loading_screen/loading_support.html">Support Client</a></li>
                    <li><a href="loading_screen/loadng.html">Chat</a></li>
                    <li><a href="loading_screen/loading_share.html">Share files</a></li>
                    <li><a href="loading_screen/laoding_modif.html">Modify Account</a></li>
                    <li><a href="loading_screen/loading_editor.html">Code Editor</a></li>
                    <li><a href="thome.php">blog</a></li>
                    <li><a href="media/media.html">social media</a></li>
                    <li><a href="coming_soon/loading.html">Whiteboard</a></li>

                </ul>
            </div>
        </div>
    </nav>
    
    <section class="home-grid">

   <div class="box-container">

      
      

      <div class="box">
         <p>categories</p>
         <div class="flex-box">
            <a href="category.php?category=nature" class="links">nature</a>
            <a href="category.php?category=education" class="links">education</a>
            <a href="category.php?category=business" class="links">business</a>
            <a href="category.php?category=news" class="links">news</a>
            <a href="category.php?category=gaming" class="links">gaming</a>
            <a href="../../models/all_category.php" class="btn">view all</a>
         </div>
      </div>

      <div class="box">
         <p>authors</p>
         <div class="flex-box">  
         <a href="../../controller/authors.php" class="btn">view all</a>
         </div>
      </div>

   </div>

</section>

<section class="posts-container">


   <div class="box-container">

      <?php
         $select_posts = $conn->prepare("SELECT * FROM `posts` WHERE status = ? LIMIT 1");
         $select_posts->execute(['active']);
         if($select_posts->rowCount() > 0){
            while($fetch_posts = $select_posts->fetch(PDO::FETCH_ASSOC)){
               
               $post_id = $fetch_posts['id'];

               $count_post_comments = $conn->prepare("SELECT * FROM `comments` WHERE post_id = ?");
               $count_post_comments->execute([$post_id]);
               $total_post_comments = $count_post_comments->rowCount(); 

               $count_post_likes = $conn->prepare("SELECT * FROM `likes` WHERE post_id = ?");
               $count_post_likes->execute([$post_id]);
               $total_post_likes = $count_post_likes->rowCount();

               $confirm_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ? AND post_id = ?");
               $confirm_likes->execute([$user_id, $post_id]);
      ?>
      <form class="box" method="post">
         <?php
            if($fetch_posts['image'] != ''){  
         ?>
         <img src="../../assets/uploaded_img/<?= $fetch_posts['image']; ?>" class="post-image" alt="Post Image">
         <?php
         }
         ?>
         <div class="post-title"><?= $fetch_posts['title']; ?></div>
         <div class="post-content content-150"><?= $fetch_posts['content']; ?></div>
         <a href="../../controller/view_post.php?post_id=<?= $post_id; ?>" class="inline-btn">Read more</a>
         <a href="../../model/category.php?category=<?= $fetch_posts['category']; ?>" class="post-cat"> <i class="fas fa-tag"></i> <span><?= $fetch_posts['category']; ?></span></a>
         <div class="icons">
            <a href="../../controller/view_post.php?post_id=<?= $post_id; ?>"><i class="fas fa-comment"></i><span>(<?= $total_post_comments; ?>)</span></a>
            <button type="submit" name="like_post"><i class="fas fa-heart" style="<?php if($confirm_likes->rowCount() > 0){ echo 'color:var(--red);'; } ?>"></i><span>(<?= $total_post_likes; ?>)</span></button>
         </div>
      </form>
      <?php
         }
      }else{
         echo '<p class="empty">No posts added yet!</p>';
      }
      ?>
   </div>

   <!-- Fixer le bouton "View All Posts" -->
   <div class="more-btn fixed-btn">
      <a href="../../controller/posts.php" class="inline-btn">View All Posts</a>
   </div>

</section>


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
      <script src="index.js"></script>
      <script src="../../assets/js/script.js"></script>
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