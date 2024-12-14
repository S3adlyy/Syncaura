<?php

include '../config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['delete'])){

   $p_id = $_POST['post_id'];
   $p_id = filter_var($p_id, FILTER_SANITIZE_STRING);
   $delete_image = $conn->prepare("SELECT * FROM `posts` WHERE id = ?");
   $delete_image->execute([$p_id]);
   $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);
   $delete_post = $conn->prepare("DELETE FROM `posts` WHERE id = ?");
   $delete_post->execute([$p_id]);
   $delete_comments = $conn->prepare("DELETE FROM `comments` WHERE post_id = ?");
   $delete_comments->execute([$p_id]);
   $message[] = 'Post deleted successfully!';

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Syncora Dashboard</title>
    <!-- Custom fonts and styles for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="styles/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
   

   <style>
      /* Custom styles based on dashboard.php */

     /* Root Variables */
:root {
   --primary-color: #4e73df; /* Primary blue color */
   --green: #e10b0d; /* Green for active status */
   --coral: coral; /* Red for inactive status */
   --light-bg: #f5f5f5; /* Background light grey */
   --white: #fff; /* White */
   --red:#e74c3c;
   --border: 1px solid #4e73df;
    --box-shadow: 0 4px 8px #4e73df;
    --hover-shadow: 0 6px 12px #4e73df;
   --gray-dark: #34495e; /* Dark grey for titles */
   --font-family: 'Nunito', Arial, sans-serif; /* Font for readability */
}

/* Heading */
.heading {
   text-align: center;
   font-size: 2.5rem;
   font-weight: bold;
   color: var(--gray-dark);
   margin-bottom: 3rem; /* Increased margin for visual separation */
}

/* Box Container (Post Cards) */
.box-container {
   display: grid;
   grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
   gap: 2.5rem;
   justify-content: center; /* Center the items */
}

/* Individual Post Box */
.box {
   background-color: var(--white);
   border: var(--border);
   border-radius: 0.8rem;
   box-shadow: var(--box-shadow);
   padding: 2rem;
   text-align: center;
   transition: transform 0.3s ease, box-shadow 0.3s ease;
   display: flex;
   flex-direction: column;
   justify-content: space-between;
}

/* Hover Effect for Box */
.box:hover {
   transform: translateY(-8px);
   box-shadow: var(--hover-shadow);
}

/* Post Status 
.box .status {
   background-color: var(--green);
   padding: 0.6rem 1.2rem;
   border-radius: 1rem;
   color: #fff;
   margin-bottom: 1.5rem;
   font-weight: 600;
   text-transform: uppercase;
   letter-spacing: 1px;
}*/

/* Post Title */
.box .title {
   font-size: 1.9rem;
   font-weight: bold;
   margin-bottom: 1.5rem;
   color: var(--gray-dark);
   line-height: 1.4;
   transition: color 0.3s ease;
}

.box .title:hover {
   color: var(--primary-color); /* Change color on hover */
}

/* Post Content (Snippet) */
.box .posts-content {
   font-size: 1.6rem;
   margin-bottom: 1.8rem;
   color: #777;
   height: 7rem;
   overflow: hidden;
   text-overflow: ellipsis;
   line-height: 1.6;
}

/* Icons (Likes and Comments) */
.box .icons {
   display: flex;
   justify-content: space-between;
   margin-bottom: 1rem;
}

.box .icons div {
   font-size: 1.7rem;
   color: var(--primary-color);
   transition: color 0.3s ease;
}

.box .icons div:hover {
   color: var(--green); /* Change color on hover */
}

.box .icons .comments i,
.box .icons .likes i {
   margin-right: 0.6rem;
   font-size: 1.8rem; /* Slightly larger icons for better visibility */
}

/* Flex Buttons (Edit, Delete) */
.box .flex-btn {
   display: flex;
   justify-content: space-between;
   margin-top: 1.5rem;
}

/* Edit and Delete Buttons */
.box .option-btn,
.box .delete-btn {
   padding: 0.7rem 1.5rem;
   background-color: var(--primary-color);
   color: var(--white);
   text-decoration: none;
   border-radius: 0.5rem;
   font-size: 1.4rem;
   transition: background-color 0.3s ease, transform 0.3s ease;
}

.box .option-btn:hover,
.box .delete-btn:hover {
   background-color: #2c3e50;
   transform: translateY(-3px);
}

/* Add Post Button 
.btn {
   background-color: var(--primary-color);
   padding: 1rem 2.5rem;
   color: var(--white);
   font-size: 1.6rem;
   border-radius: 0.5rem;
   text-align: center;
   text-decoration: none;
   transition: background-color 0.3s ease, transform 0.3s ease;
}*/

/*.btn:hover {
   background-color: #2c3e50;
   transform: translateY(-2px);
}*/

/* Mobile Optimization */
@media (max-width: 1200px) {
   body {
      padding-left: 0;
   }
}

@media (max-width: 768px) {
   .box-container {
      grid-template-columns: 1fr;
      gap: 1.5rem;
   }

   .heading {
      font-size: 2rem;
   }

   .box .title {
      font-size: 1.6rem;
   }

   .box .posts-content {
      font-size: 1.5rem;
   }
}

@media (max-width: 450px) {
   .heading {
      font-size: 1.8rem;
   }

   .box {
      padding: 1.2rem;
   }

   .box .status {
      padding: 0.5rem 1rem;
   }

   .box .title {
      font-size: 1.4rem;
   }

   .box .posts-content {
      font-size: 1.4rem;
      height: 5rem;
   }

   .box .icons div {
      font-size: 1.4rem;
   }

   .box .option-btn,
   .box .delete-btn {
      font-size: 1.3rem;
   }
}


   </style>
</head>
<body>
<div id="wrapper">
       
       <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
           <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
               <div class="sidebar-brand-icon rotate-n-15">
                   <i class="fas fa-laugh-wink"></i>
               </div>
               <div class="sidebar-brand-text mx-3">Syncora <sup>2</sup></div>
           </a>
           <hr class="sidebar-divider my-0">
           <li class="nav-item active">
               <a class="nav-link" href="dash.php">
                   <i class="fas fa-fw fa-tachometer-alt"></i>
                   <span>Dashboard</span>
               </a>
           </li>
           <hr class="sidebar-divider">
           <div class="sidebar-heading">
               Tables
           </div>
           <li class="nav-item">
           <a class="nav-link" href="admin/admin_dasboard/users.php">
                   <i class="fas fa-fw fa-cog"></i>
                   <span>Users</span>
               </a>
               <a class="nav-link collapsed" href="table_Chatuser.php" data-toggle="collapse" data-target="#collapseTwo"
                   aria-expanded="true" aria-controls="collapseTwo">
                   <i class="fas fa-fw fa-cog"></i>
                   <span>Chat users</span>
               </a>
               <a class="nav-link collapsed" href="table_messages.php" data-toggle="collapse" data-target="#collapseTwo"
                   aria-expanded="true" aria-controls="collapseTwo">
                   <i class="fas fa-fw fa-cog"></i>
                   <span>Chat messages</span>
               </a>
               <a class="nav-link collapsed" href="fetch.php" data-toggle="collapse" data-target="#collapseTwo"
                   aria-expanded="true" aria-controls="collapseTwo">
                   <i class="fas fa-fw fa-cog"></i>
                   <span>users and messages </span>
               </a>
               <a class="nav-link collapsed" href="listPack.php" data-toggle="collapse" data-target="#collapseUtilities"
                   aria-expanded="true" aria-controls="collapseUtilities">
                   <i class="fas fa-fw fa-wrench"></i>
                   <span>Gestion Packs</span>
               </a>
               <a class="nav-link collapsed" href="recherche.php" data-toggle="collapse" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
               <i class="fas fa-fw fa-wrench"></i>
               <span>recherche  Achats</span>
           </a>
           <a class="nav-link collapsed" href="ai pack.php" data-toggle="collapse" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
               <i class="fas fa-fw fa-wrench"></i>
               <span>ai description pack</span>
           </a>

           <a class="nav-link collapsed" href="send.php" data-toggle="collapse" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
               <i class="fas fa-fw fa-wrench"></i>
               <span>Mailing</span>
           </a>
           <a class="nav-link collapsed" href="listAchat.php" data-toggle="collapse" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
               <i class="fas fa-fw fa-wrench"></i>
               <span>Gestion Achats</span>
           </a>
           <a class="nav-link collapsed" href="../views/dash/dashboard.php" data-toggle="collapse" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
               <i class="fas fa-fw fa-wrench"></i>
               <span>Blog</span>
           </a>
       </ul>

<section class="show-posts">

   <h1 class="heading" style="margin-left:500px">Your Posts</h1>

   <div class="box-container" style="margin-left: 550px;">

      <?php
         $select_posts = $conn->prepare("SELECT * FROM `posts` WHERE admin_id = ?");
         $select_posts->execute([$admin_id]);
         if($select_posts->rowCount() > 0){
            while($fetch_posts = $select_posts->fetch(PDO::FETCH_ASSOC)){
               $post_id = $fetch_posts['id'];

               $count_post_comments = $conn->prepare("SELECT * FROM `comments` WHERE post_id = ?");
               $count_post_comments->execute([$post_id]);
               $total_post_comments = $count_post_comments->rowCount();

               $count_post_likes = $conn->prepare("SELECT * FROM `likes` WHERE post_id = ?");
               $count_post_likes->execute([$post_id]);
               $total_post_likes = $count_post_likes->rowCount();

      ?>
      <form method="post" class="box">
         <input type="hidden" name="post_id" value="<?= $post_id; ?>">
         <?php if($fetch_posts['image'] != ''){ ?>
            <img src="../assets/uploaded_img/<?= $fetch_posts['image']; ?>" class="image" alt="">
         <?php } ?>
        
         <div class="title"><?= $fetch_posts['title']; ?></div>
         <div class="posts-content"><?= $fetch_posts['content']; ?></div>
         <div class="icons">
            <div class="likes"><i class="fas fa-heart"></i><span><?= $total_post_likes; ?></span></div>
            <div class="comments"><i class="fas fa-comment"></i><span><?= $total_post_comments; ?></span></div>
         </div>
         <div class="flex-btn">
            <a href="edit_post.php?id=<?= $post_id; ?>" class="option-btn">Edit</a>
            <button type="submit" name="delete" class="delete-btn" onclick="return confirm('Delete this post?');">Delete</button>
         </div>
        
      </form>
      <?php
            }
         }else{
            echo '<p class="empty">No posts added yet! <a href="add_posts.php" class="btn" style="margin-top:1.5rem;">Add Post</a></p>';
         }
      ?>
</ul>
   </div>

</section>

<script src="../assets/js/admin_script.js"></script>

</body>
</html>
