<?php
session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
require_once '../../model/pack_manager.php';
$manager = new PackManager();
$alertMessage = ""; // Variable pour stocker le message d'alerte

// Ajouter un pack au panier
if (isset($_POST['add_to_cart'])) {
    $id = $_POST['id'];
    $packs = $manager->getAllPacks();
    $pack = array_filter($packs, fn($pack) => $pack['id'] == $id);
    $pack = reset($pack);

    if ($pack) {
        // Vأ©rifie si le pack est dأ©jأ  dans le panier
        if (in_array($pack, $_SESSION['cart'], true)) {
            $alertMessage = "Ce pack est dأ©jأ  dans votre panier !";
        } else {
            $_SESSION['cart'][] = $pack;
        }
    }
}

// Supprimer un pack du panier
if (isset($_POST['remove_from_cart'])) {
    $removeId = $_POST['id'];
    $_SESSION['cart'] = array_filter($_SESSION['cart'], fn($pack) => $pack['id'] != $removeId);
    $_SESSION['cart'] = array_values($_SESSION['cart']);
}

// Finaliser l'achat
if (isset($_POST['complete_purchase'])) {
    $_SESSION['cart'] = [];
    $alertMessage = "Achat complأ©tأ© avec succأ¨s !";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier PHP</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background:#87CEEB;
            color: #333;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }
        .alert {
            display: none;
            padding: 15px;
            background-color: #f44336;
            color: white;
            margin-bottom: 15px;
            border-radius: 5px;
        }
        .alert.show {
            display: block;
        }
        .alert.success {
            background-color: #4CAF50;
        }
        h1 {
            text-align: center;
            color: #007BFF;
            margin-bottom: 20px;
        }
        .cart-icon {
            position: fixed;
            top: 20px;
            right: 20px;
            font-size: 2.5em;
            color: #007BFF;
            cursor: pointer;
        }
        .cart-icon .badge {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: red;
            color: white;
            font-size: 0.9em;
            padding: 5px 10px;
            border-radius: 50%;
        }
        .pack {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background:WHITE;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .pack img {
            width: 300px;
            height: auto;
            margin-bottom: 10px;
            border-radius: 10px;
            transition: transform 0.3s;
        }
        .pack img:hover {
            transform: scale(1.1);
        }
        .pack h2 {
            color: #333;
        }
        .pack p {
            color: #666;
        }
        .pack .price {
            font-weight: bold;
            color: #007BFF;
        }
        .button {
            background: #007BFF;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        .button:hover {
            background: #0056b3;
        }
        .cart-container {
            margin-top: 20px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .cart-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .cart-item img {
            width: 50px;
            height: auto;
            margin-right: 10px;
            border-radius: 5px;
        }
        .cart-empty {
            text-align: center;
            color: #666;
        }
    </style>
</head>
<body>
    <!-- Zone d'alerte -->
    <div id="alertBox" class="alert <?= $alertMessage ? 'show' : '' ?>">
        <?= htmlspecialchars($alertMessage) ?>
    </div>

    <!-- Icأ´ne du panier -->
    <div class="cart-icon">
        <i class="fas fa-shopping-cart"></i>
        <?php $cartCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
        <?php if ($cartCount > 0): ?>
            <span class="badge"><?= $cartCount ?></span>
        <?php endif; ?>
    </div>

    <div class="container">
        <h1>Packs Disponibles</h1>
        <?php $packs = $manager->getAllPacks(); ?>
        <div>
            <?php foreach ($packs as $pack): ?>
                <div class="pack">
                    <h2><?= htmlspecialchars($pack['nom']) ?></h2>
                    <img src="<?= htmlspecialchars($pack['image_url']) ?>" alt="<?= htmlspecialchars($pack['nom']) ?>">
                    <p><?= htmlspecialchars($pack['description']) ?></p>
                    <p class="price"><?= htmlspecialchars($pack['prix']) ?> dt</p>
                    <form action="" method="POST">
                        <input type="hidden" name="id" value="<?= $pack['id'] ?>">
                        <button type="submit" name="add_to_cart" class="button">Ajouter au Panier</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Panier -->
        <div class="cart-container">
            <h2>Mon Panier</h2>
            <?php if (!empty($_SESSION['cart'])): ?>
                <?php foreach ($_SESSION['cart'] as $item): ?>
                    <div class="cart-item">
                        <img src="<?= htmlspecialchars($item['image_url']) ?>" alt="<?= htmlspecialchars($item['nom']) ?>">
                        <span><?= htmlspecialchars($item['nom']) ?> - <?= htmlspecialchars($item['prix']) ?> dt</span>
                        <form action="" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                            <button type="submit" name="remove_from_cart" class="button" style="background:red;">Supprimer</button>
                        </form>
                    </div>
                <?php endforeach; ?>
                <form action="" method="POST">
                    <button type="submit" name="complete_purchase" class="button">Complأ©ter votre Achat</button>
                </form>
            <?php else: ?>
                <p class="cart-empty">Votre panier est vide.</p>
            <?php endif; ?>
        </div>
    </div>

    <script>// Masquer l'alerte aprأ¨s 5 secondes
        setTimeout(() => {
            const alertBox = document.getElementById('alertBox');
            if (alertBox) {
                alertBox.classList.remove('show');
            }
        }, 2000);</script>
</body>
</html>
