<?php
include '../config.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
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
    <link rel="stylesheet" href="style.css">
    <!-- Liens CSS supplémentaires -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
    <link rel="stylesheet" href="../views/front/css/posts.css">
    
    <!-- CSS personnalisé -->
    <style>
        /* Container with scrolling */
        .scrollable-container {
            max-height: 80vh; /* Limite la hauteur de la page */
            overflow-y: auto; /* Permet le défilement vertical */
            padding: 20px;
            background: rgba(255, 255, 255, 0.7); 
            width: 500px;
        }

        .container-custom {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            color: #000;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .post-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .post-content {
            font-size: 16px;
            color: #555;
        }

        .box-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .box {
            background: #f9f9f9;
            padding: 20px;
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .post-image {
            max-width: 100%;
            border-radius: 8px;
        }

        .icons {
            display: flex;
            gap: 15px;
            color: #333;
        }

        .icons i {
            margin-right: 5px;
        }

        /* Style pour le bouton de retour à la page d'accueil */
        .back-to-home-btn {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            display: inline-block;
        }

        .back-to-home-btn:hover {
            background-color: #0056b3;
        }
    </style>
    
</head>

<body>
<nav class="site-nav mb-5 sticky-nav">
        <div class="container position-relative">
            <div class="site-navigation text-center">
                <a href="../views/front/main.html" class="logo menu-absolute m-0" align="left">SyncAura<span class="text-primary">.</span></a>
                <ul class="site-menu d-flex justify-content-center align-items-center">
                    <li><a href="../front/createmeet/loadng2.php">Cree un meet</a></li>
                    <li><a href="./Ai/loding3.php">Ai ChatBot</a></li>
                    <li><a href="./promodor/index.php">Pomodoro Timer</a></li>
                    <li><a href="">Acheter un Pack</a></li>
                    <li><a href="todo.php">To Do List</a></li>
                    <li><a href="contact.php">Support Client</a></li>
                    <li><a href="index.html">Chat</a></li>
                    <li><a href="./white/white.php">Whiteboard</a></li>
                    <li><a href="../views/front/thome.php">blog</a></li>
                </ul>
            </div>
        </div>
    </nav>

<!-- Conteneur scrollable -->
<div class="scrollable-container">
    

    <!-- Contenu des posts -->
    <section class="posts-container">
        <h1 class="heading">Latest Posts</h1>

        <div class="box-container">
            <?php
            $select_posts = $conn->prepare("SELECT * FROM `posts` WHERE status = ?");
            $select_posts->execute(['active']);
            if ($select_posts->rowCount() > 0) {
                while ($fetch_posts = $select_posts->fetch(PDO::FETCH_ASSOC)) {

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
                    
                    <div class="post-admin">
                        <i class="fas fa-user"></i>
                        <div>
                            <a>see all posts in our syncaura blog</a>
                            <div><?= $fetch_posts['date']; ?></div>
                        </div>
                    </div>

                    <?php if ($fetch_posts['image'] != '') { ?>
                    <img src="../assets/uploaded_img/<?= $fetch_posts['image']; ?>" class="post-image" alt="">
                    <?php } ?>

                    <div class="post-title"><?= $fetch_posts['title']; ?></div>
                    <div class="post-content content-150"><?= $fetch_posts['content']; ?></div>
                    <a href="view_post.php?post_id=<?= $post_id; ?>" class="inline-btn">read more</a>
                    <a href="../model/category.php?category=<?= $fetch_posts['category']; ?>" class="post-cat"> <i class="fas fa-tag"></i> <span><?= $fetch_posts['category']; ?></span></a>
                    <div class="icons">
                        <a href="view_post.php?post_id=<?= $post_id; ?>"><i class="fas fa-comment"></i><span>(<?= $total_post_comments; ?>)</span></a>
                        <button type="submit" name="like_post"><i class="fas fa-heart" style="<?php if ($confirm_likes->rowCount() > 0) {
                            echo 'color:var(--red);';
                        } ?>"></i><span>(<?= $total_post_likes; ?>)</span></button>
                    </div>
                </form>
            <?php
                }
            } else {
                echo '<p class="empty">No posts added yet!</p>';
            }
            ?>
        </div>
    </section>

    <!-- Spline Viewer -->
    <div class="spline-viewer">
    <spline-viewer url="https://prod.spline.design/BK83Flm76SwRJlHz/scene.splinecode"></spline-viewer>
    </div>

    <!-- Bouton Retour à la page d'accueil -->
    <a href="../views/front/thome.php">
        <button class="back-to-home-btn">Retour à l'accueil</button>
    </a>

</div> <!-- End of scrollable-container -->

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
