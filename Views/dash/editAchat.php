<?php
include 'C:\xampp\htdocs\integration3\controller\achatA.php'; // Update with the correct controller

$error = "";

// Create an instance of the controller
$AchatManager = new AchatManager();

// Check if the form was submitted
if (
    isset($_POST["Ida"]) &&
    isset($_POST["NomUser "]) &&
    isset($_POST["Email"]) &&

    isset($_POST["IdPack"])
) {
    if (
        !empty($_POST["Ida"]) &&
        !empty($_POST['NomUser ']) &&
        !empty($_POST["Email"]) &&
        !empty($_POST["IdPack"])
    ) {
        // Create an Achat object
        $achat = new Achat(
            $_POST['Ida'],
            $_POST['NomUser '],
            $_POST['Email'],
            $_POST['IdPack']
        );
        
        // Update the achat
        $AchatManager->updateAchat($achat, $_POST["Ida"]);
        
        // Redirect to the list page after the update
        header('Location: listAchat.php');
        exit(); // End the script after the redirection
    } else {
        $error = "Missing information";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Achat</title>
    <style>
        /* Sidebar styles */
        #sidebar {
            width: 250px;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #f4f4f4;
            padding-top: 20px;
            padding-left: 20px;
        }
        #sidebar a {
            display: block;
            padding: 10px 0;
            text-decoration: none;
            color: #333;
            font-size: 18px;
        }
        #sidebar a:hover {
            background-color: #ddd;
        }
        /* Main content styles */
        #content {
            margin-left: 270px;
            padding: 20px;
        }
        table {
            width: 50%;
            margin: 0 auto;
            border-collapse: collapse;
        }
        td {
            padding: 10px;
        }
        .form-container {
            width: 80%;
            margin: 20px auto;
        }
        #error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div id="sidebar">
        <a href="dashboard.php">Dashboard</a>
        <a href="listAchat.php">Achat List</a>
        <a href="logout.php">Logout</a>
    </div>

    <!-- Main content -->
    <div id="content">
        <button><a href="listAchat.php">Back to list</a></button>
        <hr>
        <div id="error">
            <?php echo $error; ?>
        </div>

        <?php
        // Show the achat based on the ID passed in the request
        if (isset($_POST['Ida'])) {
            $achat = $AchatManager->showAchat($_POST['Ida']);
            if ($achat) { // Check if the achat data is valid
        ?>

        <div class="form-container">
            <form action="" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();" novalidate>
                <table border="1">
                    <tr>
                        <td>
                            <label for="Ida">Id Achat:</label>
                        </td>
                        <td><input type="text" name="Ida" id="Ida" value="<?php echo $achat['ida']; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td>
                            <label for="NomUser ">Nom User:</label>
                        </td>
                        <td><input type="text" name="NomUser " id="NomUser " value="<?php echo $achat['nom_user']; ?>"></td>
                    </tr>
                    <tr>
                        <td>
                            <label for="Email">Email:</label>
                        </td>
                        <td><input type="email" name="Email" id="Email" value="<?php echo $achat['email']; ?>"></td>
                    </tr>
                    <tr>
                        <td>
                            <label for="IdPack">Id Pack:</label>
                        </td>
                        <td><input type="text" name="IdPack" id="IdPack" value="<?php echo $achat['idPack']; ?>"></td>
                    </tr>

                    <tr>
                        <td colspan="2" align="center">
                            <input type="submit" value="Modify">
                        </td>
                    </tr>
                </table>
            </form>
        </div>

        <?php 
            } else {
                echo "<div id='error'>Achat not found.</div>";
            }
        } 
        ?>
**


    </div>
</body>
</html>