<?php
include '../config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['save'])){

   $post_id = $_GET['id'];
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $content = $_POST['content'];
   $content = filter_var($content, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);
   $status = $_POST['status'];
   $status = filter_var($status, FILTER_SANITIZE_STRING);

   $update_post = $conn->prepare("UPDATE `posts` SET title = ?, content = ?, category = ?, status = ? WHERE id = ?");
   $update_post->execute([$title, $content, $category, $status, $post_id]);

   $message[] = 'post updated!';

   $old_image = $_POST['old_image'];
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../assets/uploaded_img/'.$image;

   $select_image = $conn->prepare("SELECT * FROM `posts` WHERE image = ? AND admin_id = ?");
   $select_image->execute([$image, $admin_id]);

   if(!empty($image)){
      if($image_size > 2000000){
         $message[] = 'images size is too large!';
      } elseif($select_image->rowCount() > 0 AND $image != ''){
         $message[] = 'please rename your image!';
      } else {
         $update_image = $conn->prepare("UPDATE `posts` SET image = ? WHERE id = ?");
         move_uploaded_file($image_tmp_name, $image_folder);
         $update_image->execute([$image, $post_id]);
         if($old_image != $image AND $old_image != ''){
            unlink('../assets/uploaded_img/'.$old_image);
         }
         $message[] = 'image updated!';
      }
   }

}

if(isset($_POST['delete_post'])){

   $post_id = $_POST['post_id'];
   $post_id = filter_var($post_id, FILTER_SANITIZE_STRING);
   $delete_image = $conn->prepare("SELECT * FROM `posts` WHERE id = ?");
   $delete_image->execute([$post_id]);
   $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);
   if($fetch_delete_image['image'] != ''){
      unlink('../assets/uploaded_img/'.$fetch_delete_image['image']);
   }
   $delete_post = $conn->prepare("DELETE FROM `posts` WHERE id = ?");
   $delete_post->execute([$post_id]);
   $delete_comments = $conn->prepare("DELETE FROM `comments` WHERE post_id = ?");
   $delete_comments->execute([$post_id]);
   $message[] = 'post deleted successfully!';

}

if(isset($_POST['delete_image'])){

   $empty_image = '';
   $post_id = $_POST['post_id'];
   $post_id = filter_var($post_id, FILTER_SANITIZE_STRING);
   $delete_image = $conn->prepare("SELECT * FROM `posts` WHERE id = ?");
   $delete_image->execute([$post_id]);
   $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);
   if($fetch_delete_image['image'] != ''){
      unlink('../assets/uploaded_img/'.$fetch_delete_image['image']);
   }
   $unset_image = $conn->prepare("UPDATE `posts` SET image = ? WHERE id = ?");
   $unset_image->execute([$empty_image, $post_id]);
   $message[] = 'image deleted successfully!';

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Post</title>

   <!-- Font Awesome CDN Link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom Embedded CSS -->
   <style>
      /* Root variables for colors and layout */
      :root {
         --primary-color: #4e73df;
         --gray-dark: #34495e;
         --gray-light: #f2f2f2;
         --red: #e74c3c;
         --white: #fff;
         --border: 1px solid #4e73df;
         --box-shadow: 0 1px 3px #4e73df;
         --light-bg: #f8f8f8;
      }

      body {
         background-color: var(--light-bg);
         font-family: Nunito, sans-serif;
         padding-left: 23rem; /* Space for the sidebar */
         margin: 0;
      }

      /* Sidebar (Header) */
      .header {
         position: fixed;
         top: 0;
         left: 0;
         background-color: var(--white);
         z-index: 1000;
         width: 20rem;
         min-height: 100vh;
         padding: 1.5rem;
         text-align: center;
      }

      .header .logo {
         font-size: 2rem;
         color: var(--gray-dark);
      }

      .header .navbar {
         padding: 1rem 0;
      }

      .header .navbar a {
         display: block;
         padding: 1.5rem 0;
         font-size: 1.8rem;
         color: var(--gray-dark);
         text-align: left;
         transition: background-color 0.3s ease;
      }

      .header .navbar a:hover {
         background-color: var(--primary-color);
         color: var(--white);
      }

      .header .navbar a i {
         margin-right: 1rem;
         color: var(--primary-color);
      }

      .header .navbar a:hover i {
         color: var(--white);
      }

      /* Post editor */
      .post-editor {
         margin-top: 5rem;
         padding: 2rem;
         flex-grow: 1;
         max-width: 1000px;
         margin-left: auto;
         margin-right: auto;
      }

      .post-editor .heading {
         text-align: center;
         font-size: 3rem;
         margin-bottom: 2rem;
         color: var(--gray-dark);
      }

      .post-editor .box {
         background-color: var(--white);
         border: var(--border);
         border-radius: 0.5rem;
         box-shadow: var(--box-shadow);
         text-align: center;
         padding: 1.5rem;
         width: 100%;
         margin-bottom: 1rem;
         transition: transform 0.3s ease, box-shadow 0.3s ease;
      }

      .post-editor .box:hover {
         transform: translateY(-5px);
         box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.2);
      }

      .post-editor .box input,
      .post-editor .box select,
      .post-editor .box textarea {
         width: 100%;
         padding: 1rem;
         border: var(--border);
         border-radius: 0.5rem;
         font-size: 1.6rem;
         margin-top: 1rem;
      }

      .post-editor .box textarea {
         resize: vertical;
         height: 200px;
      }

      .post-editor .box input[type="file"] {
         padding: 0.5rem;
         border-radius: 0.5rem;
         border: var(--border);
         margin-top: 1rem;
      }

      .post-editor .flex-btn {
         display: flex;
         justify-content: space-between;
         gap: 1rem;
         margin-top: 2rem;
      }

      .post-editor .flex-btn .btn,
      .post-editor .flex-btn .option-btn {
         background-color: var(--primary-color);
         color: var(--white);
         font-size: 1.8rem;
         padding: 1rem 2rem;
         border-radius: 0.5rem;
         text-align: center;
         transition: background-color 0.3s ease;
         width: 48%;
         cursor: pointer;
      }

      .post-editor .flex-btn .btn:hover,
      .post-editor .flex-btn .option-btn:hover {
         background-color: var(--gray-dark);
      }

      .post-editor .flex-btn .option-btn {
         background-color: var(--gray-light);
      }

      .post-editor select {
         background-color: var(--white);
         cursor: pointer;
      }

      /* Image handling for posts */
      .post-editor img {
         max-width: 100%;
         border-radius: 0.5rem;
         margin-top: 1rem;
      }

      .inline-delete-btn {
         background-color: var(--red);
         color: var(--white);
         padding: 1rem 2rem;
         border-radius: 0.5rem;
         cursor: pointer;
         width: 100%;
         margin-top: 1rem;
         border: none;
         transition: background-color 0.3s ease;
      }

      .inline-delete-btn:hover {
         background-color: #c0392b;
      }

      /* Buttons */
      .delete-btn {
         background-color: var(--red);
         color: var(--white);
         font-size: 1.8rem;
         padding: 1rem 2rem;
         border-radius: 0.5rem;
         width: 48%;
         cursor: pointer;
         transition: background-color 0.3s ease;
      }

      .delete-btn:hover {
         background-color: #c0392b;
      }

      .option-btn {
         background-color: var(--gray-light);
      }

      .option-btn:hover {
         background-color: var(--gray-dark);
      }

   </style>
</head>
<body>

<?php include '../view/backoffice/admin_header.php' ?>

<section class="post-editor">
   <h1 class="heading">Edit Post</h1>

   <?php
      $post_id = $_GET['id'];
      $select_posts = $conn->prepare("SELECT * FROM `posts` WHERE id = ?");
      $select_posts->execute([$post_id]);
      if($select_posts->rowCount() > 0){
         while($fetch_posts = $select_posts->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="old_image" value="<?= $fetch_posts['image']; ?>">
      <input type="hidden" name="post_id" value="<?= $fetch_posts['id']; ?>">
      <p>Post Status <span>*</span></p>
      <select name="status" class="box" required>
         <option value="<?= $fetch_posts['status']; ?>" selected><?= $fetch_posts['status']; ?></option>
         <option value="active">active</option>
         <option value="deactive">deactive</option>
      </select>
      <p>Post Title <span>*</span></p>
      <input type="text" name="title" maxlength="100" required placeholder="Add post title" class="box" value="<?= $fetch_posts['title']; ?>">
      <p>Post Content <span>*</span></p>
      <textarea name="content" class="box" required maxlength="10000" placeholder="Write your content..." cols="30" rows="10"><?= $fetch_posts['content']; ?></textarea>
      <p>Post Category <span>*</span></p>
      <select name="category" class="box" required>
         <option value="<?= $fetch_posts['category']; ?>" selected><?= $fetch_posts['category']; ?></option>
         <!-- List of categories -->
         <option value="nature">Nature</option>
         <option value="education">Education</option>
         <option value="pets and animals">Pets and Animals</option>
         <option value="technology">Technology</option>
         <option value="fashion">Fashion</option>
         <option value="entertainment">Entertainment</option>
         <option value="movies and animations">Movies</option>
         <option value="gaming">Gaming</option>
         <option value="music">Music</option>
         <option value="sports">Sports</option>
         <option value="news">News</option>
         <option value="travel">Travel</option>
         <option value="comedy">Comedy</option>
         <option value="design and development">Design and Development</option>
         <option value="food and drinks">Food and Drinks</option>
         <option value="lifestyle">Lifestyle</option>
         <option value="personal">Personal</option>
         <option value="health and fitness">Health and Fitness</option>
         <option value="business">Business</option>
         <option value="shopping">Shopping</option>
         <option value="animations">Animations</option>
      </select>
      <p>Post Image</p>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
      <?php if($fetch_posts['image'] != ''){ ?>
         <img src="../assets/uploaded_img/<?= $fetch_posts['image']; ?>" class="image" alt="">
         <input type="submit" value="Delete Image" class="inline-delete-btn" name="delete_image">
      <?php } ?>
      <div class="flex-btn">
         <input type="submit" value="Save Post" name="save" class="btn">
         <a href="view_posts.php" class="option-btn">Go Back</a>
         <input type="submit" value="Delete Post" class="delete-btn" name="delete_post">
      </div>
   </form>

   <?php
         }
      } else {
         echo '<p class="empty">No posts found!</p>';
   ?>
   <div class="flex-btn">
      <a href="view_posts.php" class="option-btn">View Posts</a>
      <a href="../model/add_posts.php" class="option-btn">Add Posts</a>
   </div>
   <?php
      }
   ?>

</section>

<script src="../assets/js/admin_script.js"></script>

</body>
</html>
