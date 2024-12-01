<?php
include 'C:/xampp/htdocs/Forum/config.php'; // Inclure la configuration de connexion à la base de données
include 'C:/xampp/htdocs/Forum/Model/Reponse.php';

class reponseC
{


    public function listReponse()
    {
        $sql = "SELECT * FROM reponse"; // Requête pour récupérer toutes les réponses
        $db = config::getConnexion(); // Connexion à la base de données

        try {
            $list = $db->query($sql); // Exécution de la requête
            return $list; // Retourne le résultat
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage(); // Affiche une erreur en cas d'échec
        }
    }





    // Fonction pour ajouter une réponse
    public function addReponse($reponse)
    {
        $sql = "INSERT INTO reponse (id_reponse, contenu, date_reponse, id_question)
                VALUES (NULL, :contenu, :date_reponse, :id_question)";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'contenu' => $reponse->getcontenu(),
                'date_reponse' => $reponse->getdate_reponse()->format('Y-m-d H:i:s'),
                'id_question' => $reponse->getid_question(),
                
            ]);
            echo "Reponse added successfully!";
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Fonction pour mettre à jour une réponse
    public function updateReponse($reponse, $id_reponse)
    {
        $sql = "UPDATE reponse SET 
                contenu = :contenu, 
                date_reponse = :date_reponse, 
                id_question = :id_question 
                WHERE id_reponse = :id_reponse";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_reponse' => $id_reponse,
                'contenu' => $reponse->getcontenu(),
                'date_reponse' => $reponse->getdate_reponse()->format('Y-m-d H:i:s'),
                'id_question' => $reponse->getid_question(),
            ]);
            echo $query->rowCount() . " record(s) updated successfully!";
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }



    // Fonction pour supprimer une réponse
    public function deleteReponse($id_reponse)
    {
        $sql = "DELETE FROM reponse WHERE id_reponse = :id_reponse";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        $query=bindValue(':id_reponse',$id_reponse);


        try {
            
            $query->execute();
        
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
