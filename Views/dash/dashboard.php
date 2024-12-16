<?php
include '../../config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
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
            --red:#e74c3c;
            --green: #28a745;
            --blue: #17a2b8;
            --yellow: #ffc107;
            --gray-dark: #34495e;
            --white: #fff;
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
      /* Dashboard */
.dashboard {
    margin-top: 5rem; /* Reduced margin-top */
    padding: 1rem; /* Reduced padding */
    flex-grow: 1;
}

.dashboard .heading {
    text-align: center;
    font-size: 2.5rem; /* Reduced font size */
    margin-bottom: 1.5rem; /* Reduced margin-bottom */
    color: var(--gray-dark);
}

.dashboard .box-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); /* Reduced min-width of boxes */
    gap: 1rem; /* Reduced gap */
}

.dashboard .box {
    background-color: var(--white);
    border: var(--border);
    border-radius: 0.5rem;
    box-shadow: var(--box-shadow);
    text-align: center;
    padding: 1.5rem; /* Reduced padding inside boxes */
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.dashboard .box:hover {
    transform: translateY(-5px); /* Slightly smaller hover effect */
    box-shadow: 0 1rem 1.5rem rgba(0, 0, 0, 0.2); /* Smaller box-shadow on hover */
}

.dashboard .box h3 {
    font-size: 2rem; /* Reduced font size */
    color: var(--gray-dark);
    margin-bottom: 1rem; /* Reduced margin */
}

.dashboard .box i {
    font-size: 2.5rem; /* Reduced icon size */
    color: var(--primary-color);
    margin-bottom: 1rem; /* Reduced margin */
}

.dashboard .box a {
    display: inline-block;
    margin-top: 1rem;
    padding: 1rem 2.5rem; /* Reduced button padding */
    background-color: var(--primary-color);
    color: var(--white);
    font-size: 1.6rem; /* Reduced font size */
    text-transform: capitalize;
    border-radius: 0.5rem;
    text-align: center;
    transition: background-color 0.3s ease;
}

.dashboard .box a:hover {
    background-color: var(--gray-dark);
}

        /* Media Queries */
        @media (max-width: 1200px) {
            body {
                padding-left: 0;
            }
        }

        @media (max-width: 450px) {
            .dashboard .box-container {
                grid-template-columns: 1fr;
            }

            .dashboard .heading {
                font-size: 2.5rem;
            }
        }
    </style>
<style>
.img {
    width: 80px; /* Adjust to your preferred size */
    height: 50px; /* Maintain a square aspect ratio */
    border-radius: 80%; /* Circular shape */
    overflow: hidden; /* Ensures the image fits within the circle */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08); /* Adds a soft shadow */
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth hover animations */
    margin-right:80px;
}

.img img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ensures the image fills the circle */
}

.img:hover {
    transform: scale(1.1); /* Slightly zoom in on hover */
    box-shadow: 0 8px 10px rgba(0, 0, 0, 0.15), 0 3px 6px rgba(0, 0, 0, 0.12); /* Stronger shadow on hover */
}

    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
       
       <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
           <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dash.html">
              
               <div class="img">
                <img src="imgggg.png" alt="syncauralogo">
               </div>
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

<?php include 'admin_header.php'; ?>

<section class="dashboard">
    <div class="box-container">
        <div class="box">
            <i class="fas fa-file-alt"></i>
            <?php
            $select_posts = $conn->prepare("SELECT COUNT(*) FROM `posts` WHERE admin_id = ?");
            $select_posts->execute([$admin_id]);
            $numbers_of_posts = $select_posts->fetchColumn();
            ?>
            <h3><?= $numbers_of_posts; ?></h3>
            <p>Posts Added</p>
            <a href="../../models/add_posts.php" class="btn">Add New Post</a>
        </div>

        <div class="box">
            <i class="fas fa-check-circle" style="color: var(--green);"></i>
            <?php
            $select_active_posts = $conn->prepare("SELECT COUNT(*) FROM `posts` WHERE admin_id = ? AND status = ?");
            $select_active_posts->execute([$admin_id, 'active']);
            $numbers_of_active_posts = $select_active_posts->fetchColumn();
            ?>
            <h3><?= $numbers_of_active_posts; ?></h3>
            <p>Active Posts</p>
            <a href="../../controller/view_posts.php" class="btn">See Posts</a>
        </div>

        <div class="box">
            <i class="fas fa-users" style="color: var(--blue);"></i>
            <?php
            $select_users = $conn->prepare("SELECT COUNT(*) FROM `users`");
            $select_users->execute();
            $numbers_of_users = $select_users->fetchColumn();
            ?>
            <h3><?= $numbers_of_users; ?></h3>
            <p>Users Account</p>
            <a href="users_accounts.php" class="btn">See Users</a>
        </div>


        <div class="box">
            <i class="fas fa-comments"></i>
            <?php
            $select_comments = $conn->prepare("SELECT COUNT(*) FROM `comments` WHERE admin_id = ?");
            $select_comments->execute([$admin_id]);
            $numbers_of_comments = $select_comments->fetchColumn();
            ?>
            <h3><?= $numbers_of_comments; ?></h3>
            <p>Comments Added</p>
            <a href="../../models/comments.php" class="btn">See Comments</a>
        </div>

        <div class="box">
            <i class="fas fa-thumbs-up" style="color: var(--blue);"></i>
            <?php
            $select_likes = $conn->prepare("SELECT COUNT(*) FROM `likes` WHERE admin_id = ?");
            $select_likes->execute([$admin_id]);
            $numbers_of_likes = $select_likes->fetchColumn();
            ?>
            <h3><?= $numbers_of_likes; ?></h3>
            <p>Total Likes</p>
            <a href="../../controller/view_posts.php" class="btn">See Posts</a>
        </div>

    </div>

</section>

<script src="../../assets/js/admin_script.js"></script>

</body>
</html>
