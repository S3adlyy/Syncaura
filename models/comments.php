<?php

include '../config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:../controller/admin_login.php');
}

if (isset($_POST['delete_comment'])) {
    $comment_id = $_POST['comment_id'];
    $comment_id = filter_var($comment_id, FILTER_SANITIZE_STRING);
    $delete_comment = $conn->prepare("DELETE FROM `comments` WHERE id = ?");
    $delete_comment->execute([$comment_id]);
    $message[] = 'Comment deleted!';
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
            --dark-red: #8B0000;
            --light-bg: #f5f5f5;
            --border: 1px solid var(--gray-dark);
            --box-shadow: 0 0.5rem 1rem #4e73df;
        }

        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Comment Section */
        .comments {
            margin-top: 5rem;
            padding: 2rem;
            flex-grow: 1;
            background-color: var(--light-bg);
            border-radius: 1rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .comments .heading {
            text-align: center;
            font-size: 2.8rem;
            margin-bottom: 2rem;
            color: var(--primary-color);
            font-weight: 700;
        }

        .comments .box-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            justify-items: center;
        }

        .comments .box {
            background-color: var(--white);
            border-radius: 1rem;
            padding: 1.8rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border: 1px solid transparent;
            position: relative;
        }

        .comments .box:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
            border-color: var(--primary-color);
        }

        .comments .box .user {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .comments .box .user i {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-right: 1.2rem;
        }

        .comments .box .user .user-info {
            font-size: 1.6rem;
            color: var(--gray-dark);
            font-weight: 500;
        }

        .comments .box .text {
            font-size: 1.6rem;
            color: var(--gray-dark);
            margin-bottom: 1.5rem;
            line-height: 1.6;
            font-weight: 400;
            text-align: left;
        }

        .comments .box form {
            display: inline-block;
        }

        .comments .box .inline-delete-btn {
            padding: 1rem 3rem;
            background-color: var(--red);
            color: var(--white);
            font-size: 1.6rem;
            border-radius: 0.5rem;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            border: none;
            margin-top: 1.5rem;
            width: 100%;
        }

        .comments .box .inline-delete-btn:hover {
            background-color: var(--dark-red);
            transform: scale(1.05);
        }

        .comments .box .inline-delete-btn:active {
            transform: scale(1);
        }

        .comments .empty {
            text-align: center;
            font-size: 1.8rem;
            color: var(--gray-dark);
            margin-top: 2rem;
            font-weight: 500;
        }

        .comments .post-title {
            font-size: 1.6rem;
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1rem;
            text-align: left;
        }

        .comments .post-title span {
            font-weight: 500;
            color: var(--gray-dark);
        }

        .comments .post-title a {
            color: var(--primary-color);
            font-weight: 500;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .comments .post-title a:hover {
            color: var(--primary-color);
            text-decoration: underline;
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


<?php include '../views/dash/admin_header.php' ?>

<section class="comments">

    <h1 class="heading">Posts Comments</h1>

    <p class="comment-title">Post Comments</p>
    <div class="box-container">
        <?php
        $select_comments = $conn->prepare("SELECT * FROM `comments` WHERE admin_id = ?");
        $select_comments->execute([$admin_id]);
        if ($select_comments->rowCount() > 0) {
            while ($fetch_comments = $select_comments->fetch(PDO::FETCH_ASSOC)) {
                
                // Fetch user name for the comment based on user_id
                $user_id = $fetch_comments['user_id'];
                $select_user = $conn->prepare("SELECT name FROM `users` WHERE id = ?");
                $select_user->execute([$user_id]);
                $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);
                $user_name = $fetch_user ? $fetch_user['name'] : 'Unknown'; // Fallback in case user is not found

                // Fetch the post associated with the comment
                $select_posts = $conn->prepare("SELECT * FROM `posts` WHERE id = ?");
                $select_posts->execute([$fetch_comments['post_id']]);
                while ($fetch_posts = $select_posts->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="post-title">From: <span><?= $fetch_posts['title']; ?></span> <a href="../view/backoffice/read_post.php?post_id=<?= $fetch_posts['id']; ?>">View Post</a></div>
            <?php
                }
            ?>
        <div class="box">
            <div class="user">
                <i class="fas fa-user"></i>
                <div class="user-info">
                    <span><?= $user_name; ?></span> <!-- Display the correct user's name -->
                    <div><?= $fetch_comments['date']; ?></div>
                </div>
            </div>
            <div class="text"><?= $fetch_comments['comment']; ?></div>
            <form action="" method="POST">
                <input type="hidden" name="comment_id" value="<?= $fetch_comments['id']; ?>">
                <button type="submit" class="inline-delete-btn" name="delete_comment" onclick="return confirm('Delete this comment?');">Delete Comment</button>
            </form>
        </div>
        <?php
            }
        } else {
            echo '<p class="empty">No comments added yet!</p>';
        }
        ?>
    </div>

</section>

<script src="../assets/js/admin_script.js"></script>

</body>

</html>
