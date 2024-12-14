<?php

include '../config.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_GET['category'])){
   $category = $_GET['category'];
}else{
   $category = '';
}

include 'like_post.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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


<section class="posts-container">

   <h1 class="heading">post categories</h1>

   <div class="box-container">

      <?php
         $select_posts = $conn->prepare("SELECT * FROM `posts` WHERE category = ? and status = ?");
         $select_posts->execute([$category, 'active']);
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
         <input type="hidden" name="post_id" value="<?= $post_id; ?>">
         <input type="hidden" name="admin_id" value="<?= $fetch_posts['admin_id']; ?>">
         <div class="post-admin">
            <i class="fas fa-user"></i>
            <div>
               <a href="../controller/author_posts.php?author=<?= $fetch_posts['name']; ?>"><?= $fetch_posts['name']; ?></a>
               <div><?= $fetch_posts['date']; ?></div>
            </div>
         </div>
         
         <?php
            if($fetch_posts['image'] != ''){  
         ?>
         <img src="../assets/uploaded_img/<?= $fetch_posts['image']; ?>" class="post-image" alt="">
         <?php
         }
         ?>
         <div class="post-title"><?= $fetch_posts['title']; ?></div>
         <div class="post-content content-150"><?= $fetch_posts['content']; ?></div>
         <a href="../controller/view_post.php?post_id=<?= $post_id; ?>" class="inline-btn">read more</a>
         <div class="icons">
            <a href="../controller/view_post.php?post_id=<?= $post_id; ?>"><i class="fas fa-comment"></i><span>(<?= $total_post_comments; ?>)</span></a>
            <button type="submit" name="like_post"><i class="fas fa-heart" style="<?php if($confirm_likes->rowCount() > 0){ echo 'color:var(--red);'; } ?>  "></i><span>(<?= $total_post_likes; ?>)</span></button>
         </div>
      
      </form>
      <?php
         }
      }else{
         echo '<p class="empty">no posts found for this category!</p>';
      }
      ?>
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