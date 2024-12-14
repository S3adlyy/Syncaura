<?php

include 'C:\xampp4\htdocs\integration3\views\config.php';
include 'C:/xampp4/htdocs/integration3/models/pack.php';

class PackController
{
    public function addPack($pack, $nomImage)
    {
        $sql = "INSERT INTO pack (nom, description, prix, image, date_achat) 
                VALUES (:nom, :description, :prix, :image, :date_achat)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $pack->getNom(),
                'description' => $pack->getDescription(),
                'prix' => $pack->getPrix(),
                'image' => $nomImage,
                'date_achat' => $pack->getDateAchat()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function updatePack($pack, $id)
    {
        $sql = "UPDATE pack SET nom = :nom, description = :description, prix = :prix, image = :image, date_achat = :date_achat WHERE id = :id";
        $db = config::getConnexion();
    
        try {
            // Check if a new image was uploaded
            $nouveau_nom_img = $pack->getImage(); 
    
            if (isset($_FILES["NouvelleImage"]) && $_FILES["NouvelleImage"]["error"] === UPLOAD_ERR_OK) {
                $img_nom = $_FILES["NouvelleImage"]["name"];
                $tmp_nom = $_FILES["NouvelleImage"]["tmp_name"];
                $time = time();
                $nouveau_nom_img = $time . "_" . $img_nom; 
                $deplacer_img = move_uploaded_file($tmp_nom, "C:\xampp\htdocs\projetrayen\view\backend\image_bdd" . $nouveau_nom_img); // Save the file to the server
    
                if (!$deplacer_img) {
                    echo "Erreur lors de l'upload de la nouvelle image";
                    return; 
                }
            }
    
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $id,
                'nom' => $pack->getNom(),
                'description' => $pack->getDescription(),
                'prix' => $pack->getPrix(),
                'image' => $nouveau_nom_img,
                'date_achat' => $pack->getDateAchat()
            ]);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    

    private function updateImagePack($id, $nouveau_nom_img)
    {
        $sql = "UPDATE pack SET image = :image WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $id,
                'image' => $nouveau_nom_img
            ]);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function deletePack($id)
    {
        $sql = "SELECT image FROM pack WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':id', $id);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
            $imageName = $result['image'];  
    
            $imagePath = "C:/xampp/htdocs/projetrayen/view/backend/image_bdd/" . $imageName;
    
            if (file_exists($imagePath)) {
                unlink($imagePath);  
            }
    
            $sql = "DELETE FROM pack WHERE id = :id";
            $query = $db->prepare($sql);
            $query->bindParam(':id', $id);
            $query->execute();
    
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    
    public function listPacks()
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

    public function showPack($id)
    {
        $sql = "SELECT * FROM pack WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':id', $id);
            $query->execute();
            $pack = $query->fetch();
            return $pack;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function getImageByIdPack($id)
    {
        $sql = "SELECT image FROM pack WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':id', $id);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result['image'];
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}

?>
