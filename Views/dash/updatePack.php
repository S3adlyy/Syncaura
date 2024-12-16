<?php
include 'C:\xampp\htdocs\integration3\controller\packP.php';

$error = "";
$pack = null;

// Create an instance of the controller
$PackController = new PackController();

if (
    isset($_POST["Id"]) &&
    isset($_POST["Nom"]) &&
    isset($_POST["Description"]) &&
    isset($_POST["Prix"]) &&
    isset($_POST["DateAchat"])
) {
    if (
        !empty($_POST["Id"]) &&
        !empty($_POST['Nom']) &&
        !empty($_POST["Description"]) &&
        !empty($_POST["Prix"]) &&
        !empty($_POST["DateAchat"])
    ) {
        // Create a Pack object
        $pack = new Pack(
            $_POST['Id'],
            $_POST['Nom'],
            $_POST['Description'],
            $_POST['Prix'],
            null, 
            $_POST['DateAchat']
        );
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imageName = $_FILES['image']['name'];

            $newImageName = time() . "_" . $imageName;

            $uploadDir = 'C:/xamp/htdocs/integration3/Views/dash/image_bdd';
            $destinationPath = $uploadDir . "/" . $newImageName; // Fix the path to include the directory

            if (move_uploaded_file($_FILES['image']['tmp_name'], $destinationPath)) {
                $pack->setImage($newImageName); 
            } else {
                $error = "Failed to upload image.";
            }
        } else {
            $error = "No valid image file uploaded.";
        }

        // Update the pack
        $PackController->updatePack($pack, $_POST["Id"], $newImageName);
        
        // Redirect to the list page after the update
        header('Location: listPack.php');
        exit(); // End the script after the redirection
    } else {
        $error = "Missing information";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Update Pack</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="styles.css" rel="stylesheet">
    <link rel="stylesheet" href="min.css">
    <script src="scriptPack.js"></script>

    <style>
        /* Centering the form and keeping the layout clean */
        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            height: calc(100vh - 100px); /* Adjust the height to keep the form vertically centered */
        }

        form {
            width: 60%; /* Adjust the form width as needed */
            margin-top: 20px;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
        }

        input[type="text"], input[type="date"], input[type="file"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Sidebar Styling */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background-color: #343a40;
            color: white;
            padding-top: 20px;
        }

        .sidebar .nav-item {
            margin-bottom: 10px;
        }

        .sidebar .nav-link {
            color: white;
            text-decoration: none;
        }

        .sidebar .nav-link:hover {
            background-color: #007bff;
        }

        .sidebar-brand {
            text-align: center;
            padding: 10px;
        }

        /* Main content wrapper adjustments */
        #content-wrapper {
            margin-left: 250px; /* Account for the sidebar width */
        }

        /* Make sidebar close icon work */
        #sidebarToggleTop {
            display: none;
        }

        /* Error styling */
        #error {
            color: red;
            text-align: center;
            margin-top: 10px;
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

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="dash.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="listPack.php" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Gestion Packs</span>
                </a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="listAchat.php" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Gestion Achats</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                </nav>

                <!-- Main Section -->
                <main>
                    <!-- Back Button -->
                    <button><a href="listPack.php">Back to list</a></button>
                    <hr>

                    <!-- Error Message -->
                    <div id="error">
                        <?php echo $error; ?>
                    </div>

                    <!-- Display the pack form -->
                    <?php
                    // Show the pack based on the ID passed in the request
                    if (isset($_POST['id'])) {
                        $pack = $PackController->showPack($_POST['id']);
                    ?>

                    <form action="" method="POST" enctype="multipart/form-data" onsubmit="return validateForm2();" novalidate>
                        <table border="1" align="center">
                            <tr>
                                <td>
                                    <label for="Id">Id Pack:</label>
                                </td>
                                <td><input type="text" name="Id" id="Id" value="<?php echo $pack['id']; ?>" readonly></td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="Nom">Nom:</label>
                                </td>
                                <td><input type="text" name="Nom" id="Nom" value="<?php echo $pack['nom']; ?>"></td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="Description">Description:</label>
                                </td>
                                <td><input type="text" name="Description" id="Description" value="<?php echo $pack['description']; ?>"></td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="Prix">Prix:</label>
                                </td>
                                <td><input type="text" name="Prix" id="Prix" value="<?php echo $pack['prix']; ?>"></td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="DateAchat">Date d'achat:</label>
                                </td>
                                <td><input type="date" name="DateAchat" id="DateAchat" value="<?php echo $pack['date_achat']; ?>"></td>
                            </tr>
                            <tr>
                            <td>
                                
                    <label for="image">Image:</label>
                </td>
                <td><input type="file" name="image" id="image" required></td>

                    <tr>
                                <td colspan="2" align="center">
                                    <input type="submit" name="submit" value="Update">
                                </td>
                            </tr>
                        </table>
                    </form>
                    <?php } ?>
                </main>
            </div>
        </div>
    </div>
</body>
</html>