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
      :root {
         --primary-color: #4e73df;
         --red: #e74c3c;
         --green: #28a745;
         --blue: #17a2b8;
         --yellow: #ffc107;
         --gray-dark: #34495e;
            --white: #fff;
            --light-bg: #f5f5f5;
            --border: 1px solid var(--gray-dark);
            --box-shadow: 0 0.5rem 1rem #4e73df;
      }
      section {
         margin: 2rem;
         padding: 2rem;
         background-color: var(--white);
         border-radius: 0.5rem;
         box-shadow: var(--box-shadow);
      }

      .heading {
         text-align: center;
         font-size: 2.5rem;
         margin-bottom: 2rem;
         color: var(--gray-dark);
      }

      .box-container {
         display: grid;
         grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
         gap: 1.5rem;
      }

      .box {
         padding: 1.5rem;
         border: var(--border);
         border-radius: 0.5rem;
         box-shadow: var(--box-shadow);
         background-color: var(--white);
         transition: all 0.3s ease;
      }

      .box:hover {
         transform: translateY(-5px);
         box-shadow: 0 1rem 1.5rem rgba(0, 0, 0, 0.2);
      }

      .box p {
         margin: 1rem 0;
         font-size: 1.6rem;
         color: var(--gray-dark);
      }

      .box span {
         font-weight: bold;
         color: var(--primary-color);
      }

      .empty {
         text-align: center;
         font-size: 1.8rem;
         color: var(--gray-dark);
      }

      @media (max-width: 1200px) {
         body {
            padding-left: 0;
         }
      }

      @media (max-width: 450px) {
         .box-container {
            grid-template-columns: 1fr;
         }
      }
   </style>
</head>
<body>
<div id="wrapper">
       
       <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
           <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dash.php">
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
           <a class="nav-link collapsed" href="dashboard.php" data-toggle="collapse" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
               <i class="fas fa-fw fa-wrench"></i>
               <span>Blog</span>
           </a>
           <a class="nav-link collapsed" href="dash_support/table_questions.php" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-question"></i>
                    <span >question support</span>
                </a>

                <a class="nav-link collapsed" href="dash_support/table_reponse.php" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-reply"></i>
                    <span >response support</span>
                </a>
                <a class="nav-link collapsed" href="dash_todo/plandash.php" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Manage Plans </span>
                </a>
                <a class="nav-link collapsed" href="dash_todo/taskdash.php" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Manage Tasks </span>
                </a>
                <a class="nav-link collapsed" href="dash_todo/searchtaskdash.php" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Search Tasks </span>
                </a>
       </ul>

<?php include 'admin_header.php' ?>

<section class="accounts">

   <h1 class="heading">Users Accounts</h1>

   <div class="box-container">

   <?php
      $select_account = $conn->prepare("SELECT * FROM `users`");
      $select_account->execute();
      if($select_account->rowCount() > 0){
         while($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)){ 
            $user_id = $fetch_accounts['id']; 
            $count_user_comments = $conn->prepare("SELECT * FROM `comments` WHERE user_id = ?");
            $count_user_comments->execute([$user_id]);
            $total_user_comments = $count_user_comments->rowCount();
            $count_user_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
            $count_user_likes->execute([$user_id]);
            $total_user_likes = $count_user_likes->rowCount();
   ?>
   <div class="box">
      <p> User ID: <span><?= $user_id; ?></span> </p>
      <p> Username: <span><?= htmlspecialchars($fetch_accounts['name']); ?></span> </p>
      <p> Total Comments: <span><?= $total_user_comments; ?></span> </p>
      <p> Total Likes: <span><?= $total_user_likes; ?></span> </p>
   </div>
   <?php
         }
      } else {
         echo '<p class="empty">No accounts available</p>';
      }
   ?>

   </div>

</section>

<script src="../../assets/js/admin_script.js"></script>

</body>
</html>
