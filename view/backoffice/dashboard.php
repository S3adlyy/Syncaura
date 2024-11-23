<?php

include '../../config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:../../controller/admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>

   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../../assets/css/admin_style.css">

</head>
<body>

<?php include 'admin_header.php' ?>


<section class="dashboard">

   <h1 class="heading">dashboard</h1>

   <div class="box-container">

   <div class="box">
      <h3>welcome!</h3>
      <p><?= $fetch_profile['name']; ?></p>
      <a href="update_profile.php" class="btn">update profile</a>
   </div>

   <div class="box">
      <?php
         $select_posts = $conn->prepare("SELECT * FROM `posts` WHERE admin_id = ?");
         $select_posts->execute([$admin_id]);
         $numbers_of_posts = $select_posts->rowCount();
      ?>
      <h3><?= $numbers_of_posts; ?></h3>
      <p>posts added</p>
      <a href="../../model/add_posts.php" class="btn">add new post</a>
   </div>

   <div class="box">
      <?php
         $select_active_posts = $conn->prepare("SELECT * FROM `posts` WHERE admin_id = ? AND status = ?");
         $select_active_posts->execute([$admin_id, 'active']);
         $numbers_of_active_posts = $select_active_posts->rowCount();
      ?>
      <h3><?= $numbers_of_active_posts; ?></h3>
      <p>active posts</p>
      <a href="../../controller/view_posts.php" class="btn">see posts</a>
   </div>

   <div class="box">
      <?php
         $select_deactive_posts = $conn->prepare("SELECT * FROM `posts` WHERE admin_id = ? AND status = ?");
         $select_deactive_posts->execute([$admin_id, 'deactive']);
         $numbers_of_deactive_posts = $select_deactive_posts->rowCount();
      ?>
      <h3><?= $numbers_of_deactive_posts; ?></h3>
      <p>deactive posts</p>
      <a href="../../controller/view_posts.php" class="btn">see posts</a>
   </div>

   <div class="box">
      <?php
         $select_users = $conn->prepare("SELECT * FROM `users`");
         $select_users->execute();
         $numbers_of_users = $select_users->rowCount();
      ?>
      <h3><?= $numbers_of_users; ?></h3>
      <p>users account</p>
      <a href="users_accounts.php" class="btn">see users</a>
   </div>

   <div class="box">
      <?php
         $select_admins = $conn->prepare("SELECT * FROM `admin`");
         $select_admins->execute();
         $numbers_of_admins = $select_admins->rowCount();
      ?>
      <h3><?= $numbers_of_admins; ?></h3>
      <p>admins account</p>
      <a href="../../controller/admin_accounts.php" class="btn">see admins</a>
   </div>
   
   <div class="box">
      <?php
         $select_comments = $conn->prepare("SELECT * FROM `comments` WHERE admin_id = ?");
         $select_comments->execute([$admin_id]);
         $select_comments->execute();
         $numbers_of_comments = $select_comments->rowCount();
      ?>
      <h3><?= $numbers_of_comments; ?></h3>
      <p>comments added</p>
      <a href="../../model/comments.php" class="btn">see comments</a>
   </div>

   <div class="box">
      <?php
         $select_likes = $conn->prepare("SELECT * FROM `likes` WHERE admin_id = ?");
         $select_likes->execute([$admin_id]);
         $select_likes->execute();
         $numbers_of_likes = $select_likes->rowCount();
      ?>
      <h3><?= $numbers_of_likes; ?></h3>
      <p>total likes</p>
      <a href="../../controller/view_posts.php" class="btn">see posts</a>
   </div>

   </div>

</section>








<script src="../../assets/js/admin_script.js"></script>

</body>
</html>