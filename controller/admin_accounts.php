<?php

include '../config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
}

// Handling account deletion
if (isset($_POST['delete'])) {
   // Delete the admin's posts, likes, comments, and the admin account itself
   $delete_image = $conn->prepare("SELECT * FROM `posts` WHERE admin_id = ?");
   $delete_image->execute([$admin_id]);
   while ($fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC)) {
      unlink('../assets/uploaded_img/' . $fetch_delete_image['image']);
   }
   $delete_posts = $conn->prepare("DELETE FROM `posts` WHERE admin_id = ?");
   $delete_posts->execute([$admin_id]);
   $delete_likes = $conn->prepare("DELETE FROM `likes` WHERE admin_id = ?");
   $delete_likes->execute([$admin_id]);
   $delete_comments = $conn->prepare("DELETE FROM `comments` WHERE admin_id = ?");
   $delete_comments->execute([$admin_id]);
   $delete_admin = $conn->prepare("DELETE FROM `admin` WHERE id = ?");
   $delete_admin->execute([$admin_id]);

   header('location:../model/admin_logout.php');
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
      /* Reset and Global Styles */
      * {
         margin: 0;
         padding: 0;
         box-sizing: border-box;
         font-family: 'Roboto', sans-serif;
      }

      body {
         background-color: #f8f9fa;
         padding: 20px;
      }
      

      h1.heading {
         text-align: center;
         font-size: 2.5rem;
         color: #343a40;
         margin-bottom: 40px;
         font-weight: 700;
         text-transform: uppercase;
      }

      .table-container {
         display: flex;
         justify-content: center;
         margin-top: 30px;
      }

      /* Table Styling */
      table {
         width: 100%;
         max-width: 1000px;
         border-collapse: collapse;
         background-color: #fff;
         box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
         border-radius: 8px;
         overflow: hidden;
      }

      th, td {
         padding: 15px;
         text-align: center;
         border-bottom: 1px solid #ddd;
      }

      th {
         background-color: #007bff;
         color: #fff;
      }

      tr:hover {
         background-color: #f1f1f1;
         cursor: pointer;
      }

      .btn-action {
         padding: 8px 15px;
         background-color: #28a745;
         color: white;
         border-radius: 5px;
         text-decoration: none;
         margin: 5px;
         transition: background-color 0.3s;
      }

      .btn-action:hover {
         background-color: #218838;
      }

      .btn-danger {
         background-color: #dc3545;
      }

      .btn-danger:hover {
         background-color: #c82333;
      }

      /* Modal Styling */
      .modal {
         display: none;
         position: fixed;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         background-color: rgba(0, 0, 0, 0.5);
         justify-content: center;
         align-items: center;
      }

      .modal-content {
         background-color: #fff;
         padding: 30px;
         border-radius: 8px;
         width: 400px;
      }

      .modal-header {
         font-size: 1.5rem;
         color: #343a40;
         margin-bottom: 20px;
      }

      .modal-footer {
         display: flex;
         justify-content: space-between;
         margin-top: 20px;
      }

      .modal .close-btn {
         background-color: #6c757d;
         color: white;
         border-radius: 5px;
         padding: 10px 20px;
         cursor: pointer;
      }

      .modal .confirm-btn {
         background-color: #dc3545;
         color: white;
         border-radius: 5px;
         padding: 10px 20px;
         cursor: pointer;
      }

      .modal .confirm-btn:hover {
         background-color: #c82333;
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

<!-- Admin Accounts Section -->
<section class="accounts">
   <h1 class="heading" style="margin-right: 1500px;"></h1>

   <div class="table-container">
      <table>
         <thead>
            <tr>
               <th>Admin ID</th>
               <th>Username</th>
               <th>Total Posts</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
            <?php
            $select_account = $conn->prepare("SELECT * FROM `admin`");
            $select_account->execute();
            if ($select_account->rowCount() > 0) {
               while ($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)) {
                  $count_admin_posts = $conn->prepare("SELECT * FROM `posts` WHERE admin_id = ?");
                  $count_admin_posts->execute([$fetch_accounts['id']]);
                  $total_admin_posts = $count_admin_posts->rowCount();
            ?>
               <tr>
                  <td><?= $fetch_accounts['id']; ?></td>
                  <td><?= $fetch_accounts['name']; ?></td>
                  <td><?= $total_admin_posts; ?></td>
                  <td>
                     <a href="../views/dash/update_profile.php?id=<?= $fetch_accounts['id']; ?>" class="btn-action">Update</a>
                     <button class="btn-action btn-danger" onclick="showModal(<?= $fetch_accounts['id']; ?>)">Delete</button>
                  </td>
               </tr>
            <?php
               }
            } else {
               echo '<tr><td colspan="4">No accounts available.</td></tr>';
            }
            ?>
         </tbody>
      </table>
   </div>

   <!-- Modal for Delete Confirmation -->
   <div id="deleteModal" class="modal">
      <div class="modal-content">
         <div class="modal-header">Are you sure you want to delete this admin account?</div>
         <div class="modal-footer">
            <button class="close-btn" onclick="closeModal()">Cancel</button>
            <form id="deleteForm" method="POST">
               <input type="hidden" name="delete" id="deleteId">
               <button type="submit" class="confirm-btn">Confirm</button>
            </form>
         </div>
      </div>
   </div>

</section>

<script>
   // Function to show the delete confirmation modal
   function showModal(adminId) {
      document.getElementById('deleteId').value = adminId;
      document.getElementById('deleteModal').style.display = 'flex';
   }

   // Function to close the modal
   function closeModal() {
      document.getElementById('deleteModal').style.display = 'none';
   }
</script>

</body>
</html>
