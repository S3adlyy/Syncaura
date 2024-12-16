<?php

include '../../config.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

if(isset($_POST['edit_comment'])){

   $edit_comment_id = $_POST['edit_comment_id'];
   $edit_comment_id = filter_var($edit_comment_id, FILTER_SANITIZE_STRING);
   $comment_edit_box = $_POST['comment_edit_box'];
   $comment_edit_box = filter_var($comment_edit_box, FILTER_SANITIZE_STRING);

   $verify_comment = $conn->prepare("SELECT * FROM `comments` WHERE comment = ? AND id = ?");
   $verify_comment->execute([$comment_edit_box, $edit_comment_id]);

   if($verify_comment->rowCount() > 0){
      $message[] = 'comment already added!';
   }else{
      $update_comment = $conn->prepare("UPDATE `comments` SET comment = ? WHERE id = ?");
      $update_comment->execute([$comment_edit_box, $edit_comment_id]);
      $message[] = 'your comment edited successfully!';
   }
   
}

if(isset($_POST['delete_comment'])){
   $delete_comment_id = $_POST['comment_id'];
   $delete_comment_id = filter_var($delete_comment_id, FILTER_SANITIZE_STRING);
   $delete_comment = $conn->prepare("DELETE FROM `comments` WHERE id = ?");
   $delete_comment->execute([$delete_comment_id]);
   $message[] = 'comment deleted successfully!';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="shortcut icon" href="imgggg.png">
   <title>Document</title>
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
    <link rel="stylesheet" href="css/login.css">

</head>
<body>
   
<nav class="site-nav mb-5 sticky-nav">
        <div class="container position-relative">
            <div class="site-navigation text-center">
                <a href="main.html" class="logo menu-absolute m-0" align="left">SyncAura<span class="text-primary">.</span></a>
                <ul class="site-menu d-flex justify-content-center align-items-center">
                <li><a href="loading_screen/loading_meet.html">Cree un meet</a></li>
                    <li><a href="Ai/loding3.html">Ai ChatBot</a></li>
                    <li><a href="loading_screen/loading_p.html">Pomodoro Timer</a></li>
                    <li><a href="loading_screen/loadngg.php">Acheter un Pack</a></li>
                    <li><a href="todo.php">To Do List</a></li>
                    <li><a href="contact.php">Support Client</a></li>
                    <li><a href="loading_screen/loadng.html">Chat</a></li>
                    <li><a href="loading_screen/loading_share.html">Share files</a></li>
                    <li><a href="loading_screen/loading_editor.html">Code Editor</a></li>
                    <li><a href="thome.php">blog</a></li>
                    <li><a href="media/media/media.html">social media</a></li>
                    <li><a href="coming_soon/loading.html">Whiteboard</a></li>


                </ul>
            </div>
        </div>
    </nav>

<?php
   if(isset($_POST['open_edit_box'])){
   $comment_id = $_POST['comment_id'];
   $comment_id = filter_var($comment_id, FILTER_SANITIZE_STRING);
?>
   <section class="comment-edit-form">
   <p>edit your comment</p>
   <?php
      $select_edit_comment = $conn->prepare("SELECT * FROM `comments` WHERE id = ?");
      $select_edit_comment->execute([$comment_id]);
      $fetch_edit_comment = $select_edit_comment->fetch(PDO::FETCH_ASSOC);
   ?>
   <form action="" method="POST">
      <input type="hidden" name="edit_comment_id" value="<?= $comment_id; ?>">
      <textarea name="comment_edit_box" required cols="30" rows="10" placeholder="please enter your comment"><?= $fetch_edit_comment['comment']; ?></textarea>
      <button type="submit" class="inline-btn" name="edit_comment">edit comment</button>
      <div class="inline-option-btn" onclick="window.location.href = 'user_comments.php';">cancel edit</div>
   </form>
   </section>
<?php
   }
?>

<section class="comments-container">

   <h1 class="heading">your comments</h1>

   <p class="comment-title">your comments on the posts</p>
   <div class="user-comments-container">
      <?php
         $select_comments = $conn->prepare("SELECT * FROM `comments` WHERE user_id = ?");
         $select_comments->execute([$user_id]);
         if($select_comments->rowCount() > 0){
            while($fetch_comments = $select_comments->fetch(PDO::FETCH_ASSOC)){
      ?>
      <div class="show-comments">
         <?php
            $select_posts = $conn->prepare("SELECT * FROM `posts` WHERE id = ?");
            $select_posts->execute([$fetch_comments['post_id']]);
            while($fetch_posts = $select_posts->fetch(PDO::FETCH_ASSOC)){
         ?>
         <div class="post-title"> from : <span><?= $fetch_posts['title']; ?></span> <a href="view_post.php?post_id=<?= $fetch_posts['id']; ?>" >view post</a></div>
         <?php
            }
         ?>
         <div class="comment-box"><?= $fetch_comments['comment']; ?></div>
         <form action="" method="POST">
            <input type="hidden" name="comment_id" value="<?= $fetch_comments['id']; ?>">
            <button type="submit" class="inline-option-btn" name="open_edit_box">edit comment</button>
            <button type="submit" class="inline-delete-btn" name="delete_comment" onclick="return confirm('delete this comment?');">delete comment</button>
         </form>
      </div>
      <?php
            }
         }else{
            echo '<p class="empty">no comments added yet!</p>';
         }
      ?>
   </div>

</section>


<div class="spline-viewer">
        <spline-viewer url="https://prod.spline.design/O4wdVneKYyKKbJbX/scene.splinecode"></spline-viewer>
      </div>

<script src="../../assets/js/script.js"></script>
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