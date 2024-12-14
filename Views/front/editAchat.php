<?php
include 'C:\xampp4\htdocs\integration3\controller\achatA.php'; // Correct controller

$error = "";
$achat = null;

// Create an instance of the controller
$AchatManager = new AchatManager();

// Check if the form was submitted
if (
    isset($_POST["Ida"]) &&
    isset($_POST["NomUser"]) &&
    isset($_POST["Email"]) &&
    isset($_POST["IdPack"])
) {
    if (
        !empty($_POST["Ida"]) &&
        !empty($_POST['NomUser']) &&
        !empty($_POST["Email"]) &&
        !empty($_POST["IdPack"])
    ) {
        // Create an Achat object
        $achat = new Achat(
            $_POST['Ida'],
            $_POST['NomUser'],
            $_POST['Email'],
            $_POST['IdPack']
        );
        
        // Update the achat using the correct object
        $AchatManager->updateAchat($achat, $_POST["Ida"]);
        
        // Redirect to the list page after the update
        header('Location: listAchat.php');
        exit(); // End the script after the redirection
    } else {
        $error = "Please fill in all required fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Achat</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to external CSS for styling -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="styleCard.css">
    <link rel="shortcut icon" href="imgggg.png">

    <style>
        /* Example internal styles for form styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f9;
        }
        .container {
            width: 60%;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .form-table {
            width: 100%;
            margin-top: 20px;
        }
        .form-table td {
            padding: 8px;
        }
        .form-table input[type="text"],
        .form-table input[type="email"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-table input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: blue;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-table input[type="submit"]:hover {
            background-color: #000080;
        }
        #error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
        .back-button {
            text-align: center;
            margin-top: 20px;
        }
        .back-button a {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-button a:hover {
            background-color: #0056b3;
        }
    </style>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="styleCard.css">
    <script src="https://unpkg.com/@splinetool/viewer/build/spline-viewer.js" type="module"></script>
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
  <link rel="stylesheet" href="css/stylo/css">
  <link rel="stylesheet" href="css/card.css">
</head>
<body>
<div class="spline-viewer">
    <spline-viewer url="https://prod.spline.design/O4wdVneKYyKKbJbX/scene.splinecode"></spline-viewer>
</div>

<div class="site-mobile-menu">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close">
        <span class="icofont-close js-menu-toggle"></span>
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
  </div>

  <nav class="site-nav mb-5">

<div class="container">
    <h1>Update Achat Information</h1>

    <div id="error">
        <?php echo $error; ?>
    </div>
   
    <?php
    // Show the achat based on the ID passed in the URL
    if (isset($_GET['id'])) {
        $achat = $AchatManager->showAchat($_GET['id']);
    ?>
    <form action="" method="POST" enctype="multipart/form-data" novalidate>
        <table class="form-table" border="1" align="center">
            <tr>
                <td><label for="Ida">purchase id :</label></td>
                <td><input type="text" name="Ida" id="Ida" value="<?php echo $achat['ida']; ?>" readonly></td>
            </tr>
            <tr>
                <td><label for="NomUser">username:</label></td>
                <td><input type="text" name="NomUser" id="NomUser" value="<?php echo $achat['nom_user']; ?>"></td>
            </tr>
            <tr>
                <td><label for="Email">Email:</label></td>
                <td><input type="email" name="Email" id="Email" value="<?php echo $achat['email']; ?>"></td>
            </tr>
    
            <tr>
                <td><label for="IdPack">Id Pack:</label></td>
                <td>
                    <select name="IdPack" id="IdPack">
                        <?php
                        // Fetch all packs from the database and create options
                        $packs = $AchatManager->getAllPacks();
                        foreach ($packs as $pack) {
                            $selected = ($pack['id'] == $achat['idPack']) ? 'selected' : ''; // Mark the selected pack
                            echo "<option value='{$pack['id']}' {$selected}>{$pack['nom']}</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="Modify">
                </td>
            </tr>
        </table>
    </form>

    <?php } ?>

    <div class="back-button">
        <a href="listAchat.php" class="back-button">Back to List</a>
    </div>
</div>
<script>
    window.onload = function () {
        const shadowRoot = document.querySelector('spline-viewer').shadowRoot;
        if (shadowRoot) {
            const logo = shadowRoot.querySelector('#logo');
            if (logo) logo.remove();
        }
    }; </script>
<script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/custom.js"></script>
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
