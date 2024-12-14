<?php
include 'C:\xampp4\htdocs\integration3\configg.php';
include 'C:\xampp4\htdocs\integration3\models\Reponse.php';

if(!class_exists("reponseC"))
{
class reponseC
{


    public function listReponse()
    {
        $sql = "SELECT r.id_reponse, r.contenu AS contenu_reponse, r.date_reponse, q.id_question, q.questions AS contenu_question FROM questions q JOIN reponse r ON q.id_question = r.id_question";
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



    public function deletereponse(int $id_reponse): bool
    {
        $sql = "DELETE FROM reponse WHERE id_reponse = :id_reponse";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id_reponse', $id_reponse, PDO::PARAM_INT);
            $query->execute();

            return $query->rowCount() > 0;
        } catch (PDOException $e) {
            error_log('Error in deletequestion: ' . $e->getMessage());
            return false;
        }
    }

    public function showReponse(int $id_reponse)
{
    $sql = "SELECT r.id_reponse, r.contenu AS contenu_reponse, r.date_reponse, q.id_question, q.questions AS contenu_question 
            FROM reponse r 
            JOIN questions q ON r.id_question = q.id_question
            WHERE r.id_reponse = :id_reponse";

    $db = config::getConnexion(); // Connexion à la base de données

    try {
        $query = $db->prepare($sql);
        $query->bindValue(':id_reponse', $id_reponse, PDO::PARAM_INT);
        $query->execute();

        // Récupérer le résultat sous forme d'objet ou de tableau associatif
        $result = $query->fetch(PDO::FETCH_ASSOC);

        return $result; // Retourner les données de la réponse
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

public function trierreponse($critere, $ordre = 'ASC') {
    $db = config::getConnexion();
    
    // Liste des colonnes valides
    $colonnesValides = ['contenu', 'date_reponse', 'id_reponse'];
    
    // Nettoyer et valider le critère de tri
    $critere = trim($critere);

    // Vérifier si le critère est valide
    if (!in_array($critere, $colonnesValides)) {
        throw new Exception("Critère de tri non valide.");
    }

    // Valider et normaliser l'ordre
    $ordre = strtoupper(trim($ordre)) === 'DESC' ? 'DESC' : 'ASC';

    try {
        // Construire et exécuter la requête
        $sql = "SELECT * FROM reponse ORDER BY $critere $ordre";
        
        $stmt = $db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        throw new Exception("Erreur PDO : " . $e->getMessage());
    }
}



}
}