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
   <title>Users Accounts</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
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

      body {
         background-color: var(--light-bg);
         font-family: Nunito, sans-serif;
         display: flex;
         justify-content: flex-start;
         padding-left: 23rem;
         transition: all 0.3s ease;
      }
          /* Header */
.header {
    position: fixed;
    top: 0;
    left: 0;
    background-color: var(--white);
    z-index: 1000;
    width: 20rem; /* Reduced width */
    min-height: 100vh;
    padding: 1.5rem; /* Reduced padding */
    text-align: center;
}

.header .logo {
    font-size: 2rem; /* Smaller logo font size */
    color: var(--gray-dark);
}

.header .navbar {
    padding: 1rem 0; /* Reduced navbar padding */
}

.header .navbar a {
    display: block;
    padding: 1.5rem 0; /* Reduced padding */
    font-size: 1.8rem; /* Smaller font size */
    color: var(--gray-dark);
    text-align: left;
    transition: background-color 0.3s ease;
}

.header .navbar a i {
    margin-right: 1rem; /* Reduced margin */
    color: var(--primary-color);
}

.header .navbar a:hover {
    background-color: var(--primary-color);
    color: var(--white);
}

.header .navbar a:hover i {
    color: var(--white);
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
