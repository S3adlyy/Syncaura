<?php
include 'C:\xampp1\htdocs\projetrayen\controller\achatA.php';

$achatManager = new AchatManager();
$packs = $achatManager->getAllPacks(); // Fetch all packs for ComboBox

// Handle form submission for adding or editing
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data and create Achat object
    $nom_user = $_POST['nom_user'];
    $email = $_POST['email'];
    $prixFinale = $_POST['prixFinale'];
    $idPack = $_POST['idPack'];

    // Create Achat object and add to the database
    $achat = new Achat(null , $nom_user, $email, $prixFinale, $idPack);
    $achatManager->addAchat($achat); // Or use updateAchat() for editing
}
?>

<!-- Form for Adding/Editing Achat -->
<form action="" method="POST">
    <table border="1" align="center">
        <tr>
            <td><label for="nom_user">Nom utilisateur:</label></td>
            <td><input type="text" name="nom_user" id="nom_user" required></td>
        </tr>
        <tr>
            <td><label for="email">Email:</label></td>
            <td><input type="email" name="email" id="email" required></td>
        </tr>
        <tr>
            <td><label for="prixFinale">Prix Finale:</label></td>
            <td><input type="number" name="prixFinale" id="prixFinale" step="0.01" required></td>
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
            <td><input type="submit" value="Save"></td>
            <td><input type="reset" value="Reset"></td>
        </tr>
    </table>
</form>
