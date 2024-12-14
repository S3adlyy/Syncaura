<?php
include '../config.php'; // Inclut le fichier de configuration pour la connexion à la base de données.

session_start(); // Démarre une session pour suivre les utilisateurs connectés.

$admin_id = $_SESSION['admin_id']; // Récupère l'ID de l'administrateur depuis la session.

if (!isset($admin_id)) { // Vérifie si l'administrateur n'est pas connecté.
    header('location:../controller/admin_login.php'); // Redirige vers la page de connexion.
}

// Si le bouton "publish" est cliqué
if (isset($_POST['publish'])) {

    // Récupère les données envoyées par le formulaire et les nettoie
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
    $category = filter_var($_POST['category'], FILTER_SANITIZE_STRING);
    $status = 'active'; // Définit le statut comme "actif" pour une publication.

    // Gère l'image téléchargée
    $image = filter_var($_FILES['image']['name'], FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size']; // Taille de l'image.
    $image_tmp_name = $_FILES['image']['tmp_name']; // Emplacement temporaire de l'image.
    $image_folder = '../assets/uploaded_img/' . $image; // Chemin cible pour l'image.

    // Vérifie si une image avec le même nom existe déjà dans la base de données
    $select_image = $conn->prepare("SELECT * FROM `posts` WHERE image = ? AND admin_id = ?");
    $select_image->execute([$image, $admin_id]);

    if (isset($image)) { // Si une image a été fournie
        if ($select_image->rowCount() > 0 && $image != '') { // Si le nom d'image est déjà utilisé
            $message[] = 'image name repeated!';
        } elseif ($image_size > 2000000) { // Si la taille de l'image dépasse 2 Mo
            $message[] = 'images size is too large!';
        } else {
            move_uploaded_file($image_tmp_name, $image_folder); // Déplace l'image dans le dossier cible.
        }
    } else {
        $image = ''; // Pas d'image fournie.
    }

    // Si l'image existe déjà, afficher un message
    if ($select_image->rowCount() > 0 && $image != '') {
        $message[] = 'please rename your image!';
    } else {
        // Insère le post dans la base de données
        $insert_post = $conn->prepare("INSERT INTO `posts`(admin_id, name, title, content, category, image, status) VALUES(?,?,?,?,?,?,?)");
        $insert_post->execute([$admin_id, $name, $title, $content, $category, $image, $status]);
        $message[] = 'post published!';
    }
}

// Si le bouton "draft" est cliqué
if (isset($_POST['draft'])) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
    $category = filter_var($_POST['category'], FILTER_SANITIZE_STRING);
    $status = 'deactive'; // Définit le statut comme "désactivé" pour un brouillon.

    $image = filter_var($_FILES['image']['name'], FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../assets/uploaded_img/' . $image;

    $select_image = $conn->prepare("SELECT * FROM `posts` WHERE image = ? AND admin_id = ?");
    $select_image->execute([$image, $admin_id]);

    if (isset($image)) {
        if ($select_image->rowCount() > 0 && $image != '') {
            $message[] = 'image name repeated!';
        } elseif ($image_size > 2000000) {
            $message[] = 'images size is too large!';
        } else {
            move_uploaded_file($image_tmp_name, $image_folder);
        }
    } else {
        $image = '';
    }

    if ($select_image->rowCount() > 0 && $image != '') {
        $message[] = 'please rename your image!';
    } else {
        $insert_post = $conn->prepare("INSERT INTO `posts`(admin_id, name, title, content, category, image, status) VALUES(?,?,?,?,?,?,?)");
        $insert_post->execute([$admin_id, $name, $title, $content, $category, $image, $status]);
        $message[] = 'draft saved!';
    }
}
?>
<script>
function validateForm() {
    // Get form inputs
    let title = document.forms["postForm"]["title"].value;
    let content = document.forms["postForm"]["content"].value;
    let category = document.forms["postForm"]["category"].value;
    let image = document.forms["postForm"]["image"].files[0];
    let imageSize = image ? image.size : 0;

    // Title validation: Max length 50 and only letters, numbers, and spaces allowed
    if (title.length > 50) {
        alert("Title should not exceed 50 characters.");
        return false;
    }
    if (!/^[a-zA-Z0-9\s]+$/.test(title)) {
        alert("Title can only contain letters, numbers, and spaces.");
        return false;
    }

    // Content validation: Max length 100
    if (content.length > 100) {
        alert("Content should not exceed 100 characters.");
        return false;
    }

    // Category validation: Must select a category
    if (category === "") {
        alert("Please select a category.");
        return false;
    }

    // Image validation: File size and type
    if (image) {
        const allowedTypes = ["image/jpeg", "image/png", "image/webp"];
        if (!allowedTypes.includes(image.type)) {
            alert("Only JPG, JPEG, PNG, and WEBP images are allowed.");
            return false;
        }
        if (imageSize > 2000000) { // 2MB
            alert("Image size should not exceed 2MB.");
            return false;
        }
    }

    return true; // All validations passed
}
</script>



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
      /* CSS styles for the post editor page */
      :root {
        --primary-color: #4e73df;
    --gray-dark: #34495e;
    --gray-light: #f2f2f2;
    --red:#e74c3c;
    --white: #fff;
    --border: 1px solid #4e73df;
    --box-shadow: 0 1px 3px #4e73df;
    --light-bg: #f8f8f8;
      }
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

<!-- Include header with sidebar -->
<?php include '../views/dash/admin_header.php'; ?>

<section class="post-editor">
   <h1 class="heading">Add New Post</h1>

   <form action="" method="post" enctype="multipart/form-data" name="postForm" onsubmit="return validateForm()">
    <input type="hidden" name="name" value="<?= $fetch_profile['name']; ?>">
    
    <div class="box">
        <p>Post Title <span>*</span></p>
        <input type="text" name="title" maxlength="100" required placeholder="Add post title" class="box">
    </div>

    <div class="box">
        <p>Post Content <span>*</span></p>
        <textarea name="content" class="box" required maxlength="10000" placeholder="Write your content..." cols="30" rows="10"></textarea>
    </div>

    <div class="box">
        <p>Post Category <span>*</span></p>
        <select name="category" class="box" required>
            <option value="" selected disabled>-- Select Category *</option>
            <option value="nature">Nature</option>
            <option value="education">Education</option>
            <option value="technology">Technology</option>
            <option value="entertainment">Entertainment</option>
            <option value="gaming">Gaming</option>
            <option value="news">News</option>
            <option value="design and development">Design and Development</option>
            <option value="business">Business</option>
        </select>
    </div>

    <div class="box">
        <p>Post Image</p>
        <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
    </div>

    <div class="flex-btn">
        <input type="submit" value="Publish Post" name="publish" class="btn">
        <input type="submit" value="Save Draft" name="draft" class="option-btn">
    </div>
</form>


</section>

<script src="../assets/js/admin_script.js"></script>
</body>
</html>
