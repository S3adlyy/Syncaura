<?php
require_once 'pack_manager.php';
$manager = new PackManager();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Packs - Admin</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #87CEEB; }
        .container { width: 80%; margin: 0 auto; padding: 20px; }
        h1 { color: #333; }
        .form-container { background-color: white; padding: 20px; border-radius: 5px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); margin-bottom: 30px; }
        .form-container input, .form-container button, .form-container select { width: 100%; padding: 10px; margin: 5px 0; border-radius: 5px; border: 1px solid #ccc; }
        .form-container button { background-color: #007BFF; color: white; cursor: pointer; }
        .form-container button:hover { background-color: #0056b3; }
        table { width: 100%; border-collapse: collapse; margin-top: 30px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 10px; text-align: center; }
        .btn-delete { background-color: #f44336; color: white; padding: 5px 10px; border: none; cursor: pointer; }
        .btn-delete:hover { background-color: #e53935; }
        .alert { padding: 10px; background-color: #007BFF; color: white; margin-bottom: 20px; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestion des Packs</h1>

        <?php if (isset($_GET['message'])): ?>
            <div class="alert"><?= htmlspecialchars($_GET['message']) ?></div>
        <?php endif; ?>

        <div class="form-container">
            <h2>Ajouter un Pack</h2>
            <form action="api.php?action=add_pack" method="POST" enctype="multipart/form-data">
                <input type="text" name="nom" placeholder="Nom" required>
                <input type="text" name="description" placeholder="Description" required>
                <input type="number" name="prix" placeholder="Prix" required>
                <input type="file" name="image" accept="image/*" required>
                <button type="submit">Ajouter</button>
            </form>
        </div>

        <div class="form-container">
            <h2>Modifier un Pack</h2>
            <form action="api.php?action=update_pack" method="POST" enctype="multipart/form-data">
                <select name="id" required>
                    <option value="">Selectionner un Pack</option>
                    <?php
                    $packs = $manager->getAllPacks();
                    foreach ($packs as $pack):
                    ?>
                        <option value="<?= htmlspecialchars($pack['id']) ?>"><?= htmlspecialchars($pack['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="text" name="nom" placeholder="Nom (facultatif)">
                <input type="text" name="description" placeholder="Description (facultatif)">
                <input type="number" name="prix" placeholder="Prix (facultatif)">
                <input type="file" name="image" accept="image/*">
                <button type="submit">Mettre a jour</button>
            </form>
        </div>

        <h2>Liste des Packs</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $packs = $manager->getAllPacks();
                foreach ($packs as $pack): ?>
                    <tr>
                        <td><?= htmlspecialchars($pack['id']) ?></td>
                        <td><?= htmlspecialchars($pack['nom']) ?></td>
                        <td><?= htmlspecialchars($pack['description']) ?></td>
                        <td><?= htmlspecialchars($pack['prix']) ?> dt</td>
                        <td><img src="<?= htmlspecialchars($pack['image_url']) ?>" style="width: 50px; height: 50px;"></td>
                        <td>
                            <form action="api.php?action=delete_pack" method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($pack['id']) ?>">
                                <button type="submit" class="btn-delete">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>


