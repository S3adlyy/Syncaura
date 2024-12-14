<?php
include 'C:\xampp4\htdocs\integration3\controller\packP.php';

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
            $_POST['NouvelleImage'], // Handle the image later
            $_POST['DateAchat']
        );
        
        // Update the pack
        $PackController->updatePack($pack, $_POST["Id"]);
        
        // Redirect to the list page after the update
        header('Location: listPack.php');
        exit(); // End the script after the redirection
    } else {
        $error = "Missing information";
    }
}

?>

<button><a href="listPack.php">Back to list</a></button>
<hr>
<div id="error">
    <?php echo $error; ?>
</div>

<?php
// Show the pack based on the ID passed in the request
if (isset($_POST['id'])) {
    $pack = $PackController->showPack($_POST['id']);
?>

<form action="" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();" novalidate>
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

        <!-- New row to update the image -->
        <tr>
            <td>
                <label for="NouvelleImage">Nouvelle Image:</label>
            </td>
            <td>
                <input type="file" name="NouvelleImage" id="NouvelleImage">
            </td>
        </tr>

        <tr>
            <td colspan="2" align="center">
                <input type="submit" value="Modifier">
            </td>
        </tr>
    </table>
</form>
<?php } ?>

<div style="text-align: center; margin-top: 20px;">
    <?php // If you need to display something here ?>
</div>
