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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- External CSS and FontAwesome -->
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

        body {
            background-color: var(--light-bg);
            display: flex;
            justify-content: flex-start;
            padding-left: 23rem;
            transition: all 0.3s ease;
            font-family: Nunito, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
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
</head>
<body>

<?php include 'admin_header.php'; ?>

<section class="dashboard">

    <h1 class="heading">Dashboard</h1>

    <div class="box-container">

        <div class="box">
            <i class="fas fa-user"></i>
            <h3>Welcome!</h3>
            <p><?= $fetch_profile['name']; ?></p>
            <a href="update_profile.php" class="btn">Update Profile</a>
        </div>

        <div class="box">
            <i class="fas fa-file-alt"></i>
            <?php
            $select_posts = $conn->prepare("SELECT COUNT(*) FROM `posts` WHERE admin_id = ?");
            $select_posts->execute([$admin_id]);
            $numbers_of_posts = $select_posts->fetchColumn();
            ?>
            <h3><?= $numbers_of_posts; ?></h3>
            <p>Posts Added</p>
            <a href="../../model/add_posts.php" class="btn">Add New Post</a>
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
            <i class="fas fa-user-shield" style="color: var(--yellow);"></i>
            <?php
            $select_admins = $conn->prepare("SELECT COUNT(*) FROM `admin`");
            $select_admins->execute();
            $numbers_of_admins = $select_admins->fetchColumn();
            ?>
            <h3><?= $numbers_of_admins; ?></h3>
            <p>Admin Accounts</p>
            <a href="../../controller/admin_accounts.php" class="btn">See Admins</a>
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
            <a href="../../model/comments.php" class="btn">See Comments</a>
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
