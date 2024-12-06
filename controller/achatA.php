<?php
include 'C:\xampp1\htdocs\projetrayen\view\config.php';
include 'C:\xampp1\htdocs\projetrayen\model\achat.php';

class AchatManage
{
    function addAchat($achat)
    {
        $sql = "INSERT INTO achat (ida, nom_user, email, prixFinale, idPack) VALUES (:ida, :nom_user, :email, :prixFinale, :idPack)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'ida' => $achat->getIda(),
                'nom_user' => $achat->getNomUser(),
                'email' => $achat->getEmail(),
                'prixFinale' => $achat->getPrixFinale(),
                'idPack' => $achat->getIdPack()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function updateAchat($achat, $ida)
    {
        $sql = "UPDATE achat SET nom_user = :nom_user, email = :email, prixFinale = :prixFinale, idPack = :idPack WHERE ida = :ida";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'ida' => $ida,
                'nom_user' => $achat->getNomUser(),
                'email' => $achat->getEmail(),
                'prixFinale' => $achat->getPrixFinale(),
                'idPack' => $achat->getIdPack()
            ]);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    
    function deleteAchat($ida)
    {
        $sql = "DELETE FROM achat WHERE ida = :ida";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':ida', $ida);
            $query->execute();
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function listAchats()
    {
        $sql = "
            SELECT achat.*, pack.nom AS pack_nom, pack.description AS pack_description 
            FROM achat
            LEFT JOIN pack ON achat.idPack = pack.id
        ";
        $db = config::getConnexion();
        try {
            $query = $db->query($sql);
            $achats = $query->fetchAll(PDO::FETCH_ASSOC); 
            return $achats;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function getAllPacks()
    {
        $sql = "SELECT * FROM pack"; 
        $db = config::getConnexion();  
        try {
            $query = $db->query($sql);
            $packs = $query->fetchAll(PDO::FETCH_ASSOC);  
            return $packs;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function showAchat($ida)
    {
        $sql = "
            SELECT achat.*, pack.nom AS pack_nom, pack.description AS pack_description 
            FROM achat
            LEFT JOIN pack ON achat.idPack = pack.id
            WHERE achat.ida = :ida
        ";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':ida', $ida);
            $query->execute();
            $achat = $query->fetch();
            return $achat;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    
public function showAchatWithImage()
{
    $sql = "
        SELECT achat.*, pack.nom AS pack_nom, pack.image AS pack_image
        FROM achat
        LEFT JOIN pack ON achat.idPack = pack.id
    ";

    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute();
        $achats = $query->fetchAll();  
        return $achats;
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}


}
?>
