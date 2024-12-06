<?php
include 'C:\xampp1\htdocs\projetrayen\controller\achatA.php';

$achatManager = new AchatManager();
$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';

if (!empty($searchTerm)) {
    // Recherche par nom d'utilisateur
    $achats = $achatManager->searchAchatsByUserName($searchTerm);
} else {
    // Afficher tous les achats si aucun terme n'est recherché
    $achats = $achatManager->listAchats();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche Achats</title>
    <style>
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f4f4f4;
        }

        .buttons {
            text-align: center;
            margin-top: 20px;
        }

        .buttons button {
            margin: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <center>
        <h1>Recherche des Achats</h1>
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Rechercher par nom d'utilisateur" value="<?php echo htmlspecialchars($searchTerm); ?>">
            <button type="submit">Rechercher</button>
        </form>
    </center>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom Utilisateur</th>
                <th>Email</th>
                <th>Pack</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($achats)): ?>
                <?php foreach ($achats as $achat): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($achat['ida']); ?></td>
                        <td><?php echo htmlspecialchars($achat['nom_user']); ?></td>
                        <td><?php echo htmlspecialchars($achat['email']); ?></td>
                        <td><?php echo htmlspecialchars($achat['idPack']); ?></td>
                        <td>
                            <a href="editAchat.php?id=<?php echo $achat['ida']; ?>">Modifier</a> |
                            <a href="deleteAchat.php?id=<?php echo $achat['ida']; ?>">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Aucun achat trouvé.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="buttons">
        <button onclick="window.location.href='listAchat.php'">Retour</button>
    </div>
</body>

</html>
