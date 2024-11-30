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

    // Title validation: Max length 100 and only letters, numbers, and spaces allowed
    if (title.length > 100) {
        alert("Title should not exceed 100 characters.");
        return false;
    }
    if (!/^[a-zA-Z0-9\s]+$/.test(title)) {
        alert("Title can only contain letters, numbers, and spaces.");
        return false;
    }

    // Content validation: Max length 10000
    if (content.length > 10000) {
        alert("Content should not exceed 10,000 characters.");
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
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Posts</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

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

      body {
         background-color: var(--light-bg);
         font-family: Nunito, sans-serif;
          padding-left: 23rem;
         
         margin: 0;
         /*padding: 0;*/
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

<!-- Include header with sidebar -->
<?php include '../view/backoffice/admin_header.php'; ?>

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
