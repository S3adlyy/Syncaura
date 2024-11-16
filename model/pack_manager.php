<?php
class PackManager {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost;dbname=gestion_packs', 'root', ''); // Remplacer par vos informations de connexion
    }

    public function getAllPacks() {
        $stmt = $this->pdo->query("SELECT * FROM packs");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addPack($nom, $description, $prix, $image_url) {
        $stmt = $this->pdo->prepare("INSERT INTO packs (nom, description, prix, image_url) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nom, $description, $prix, $image_url]);
    }

    public function updatePack($id, $nom, $description, $prix, $image_url) {
        $stmt = $this->pdo->prepare("UPDATE packs SET nom = ?, description = ?, prix = ?, image_url = ? WHERE id = ?");
        return $stmt->execute([$nom, $description, $prix, $image_url, $id]);
    }

    public function deletePack($id) {
        $stmt = $this->pdo->prepare("DELETE FROM packs WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>


