<?php
include 'C:\xampp4\htdocs\integration3\controller\achatA.php';

$achatManager = new AchatManager();
$packs = $achatManager->getAllPacks(); // Fetch all packs for ComboBox

// Handle form submission for adding or editing
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data and create Achat object
    $nom_user = $_POST['nom_user'];
    $email = $_POST['email'];
    $idPack = $_POST['idPack'];

    // Create Achat object and add to the database
    $achat = new Achat(null, $nom_user, $email, $idPack);
    $achatManager->addAchat($achat); // Or use updateAchat() for editing
    header("Location: listPack.php");
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="imgggg.png">

    <meta name="description" content=""/>
    <meta name="keywords" content="bootstrap, bootstrap4"/>

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
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
        }

        .spline-viewer {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            z-index: 1;
        }

        .form-container {
            position: relative;
            z-index: 10;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 400px;
        }

        table {
            width: 100%;
        }

        input, select {
            width: 100%;
            padding: 5px;
            margin: 5px 0;
        }

        input[type="submit"], input[type="reset"] {
            width: 48%;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
        <script src="scriptAch.js"></script>

</head>
<body>
    <div class="spline-viewer">
        <spline-viewer url="https://prod.spline.design/O4wdVneKYyKKbJbX/scene.splinecode"></spline-viewer>
    </div>

    <!-- Form for Adding/Editing Achat -->
    <div class="form-container">
        <h2>add a purchase</h2>
        <form action="" method="POST" onsubmit="return validateForm();" novalidate>>>
            <table>
                <tr>
                    <td><label for="nom_user">username:</label></td>
                    <td><input type="text" name="nom_user" id="nom_user" required></td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="email" name="email" id="email" required></td>
                </tr>
          
                <tr>
                    <td><label for="idPack">Pack:</label></td>
                    <td>
                        <select name="idPack" id="idPack" required>
                            <?php foreach ($packs as $pack): ?>
                                <option value="<?php echo $pack['id']; ?>"><?php echo $pack['nom']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr align="center">
                    <td colspan="2">
                        <input type="submit" value="Save">
                        <input type="reset" value="Reset">
                    </td>
                </tr>
            </table>
        </form>
       
        <div align="center">
    <a href="listPack.php" class="btn btn-primary">Retour à la liste</a>
</div>
    </div>

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
