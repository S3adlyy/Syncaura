<?php
include 'C:\xampp4\htdocs\integration3\configg.php';
include 'C:\xampp4\htdocs\integration3\models\questions.php';

class questionsC
{
    public function listquestion(): array
    {
        $sql = "SELECT * FROM questions";
        $db = config::getConnexion();

        try {
            $query = $db->query($sql);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error in listquestion: ' . $e->getMessage());
            return [];
        }
    }

    public function addquestion($question)
    {
    try {
        $sql = "INSERT INTO questions (questions, date_creation, id, type)
                VALUES (:questions, :date_creation, :id, :type)";

        // Get the database connection using config::getConnexion()
        $db = config::getConnexion();

        // Prepare the SQL query
        $stmt = $db->prepare($sql);

        // Bind the parameters (exclude 'id_question' since it's auto-increment)
        $stmt->bindValue(':questions', $question->getQuestions());
        $stmt->bindValue(':date_creation', $question->getDateCreation()->format('Y-m-d')); // Format the date
        $stmt->bindValue(':id', $question->getId()); // Assuming it's a valid foreign key ID
        $stmt->bindValue(':type', $question->getType());

        // Execute the query
        return $stmt->execute();
    } catch (Exception $e) {
        echo "Error in addquestion: " . $e->getMessage();
        return false;
    }
    }


    public function updatequestion(questions $question, int $id_question): bool
    {
        $sql = "UPDATE questions SET 
                questions = :questions, 
                date_creation = :date_creation, 
                id = :id, 
                type = :type
                WHERE id_question = :id_question";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id_question', $id_question, PDO::PARAM_INT);
            $query->bindValue(':questions', $question->getquestions(), PDO::PARAM_STR);
            $query->bindValue(':date_creation', $question->getDateCreation()->format('Y-m-d H:i:s'), PDO::PARAM_STR);
            $query->bindValue(':id', $question->getid(), PDO::PARAM_INT);
            $query->bindValue(':type', $question->gettype(), PDO::PARAM_STR);
            $query->execute();

            return $query->rowCount() > 0;
        } catch (PDOException $e) {
            error_log('Error in updatequestion: ' . $e->getMessage());
            return false;
        }
    }

    // Fonction pour afficher une question spécifique par ID
    public function showQuestion(int $id_question): ?array
    {
        $sql = "SELECT * FROM questions WHERE id_question = :id_question";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id_question', $id_question, PDO::PARAM_INT);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);

            // Si la question existe, retourner les résultats, sinon retourner null
            return $result ? $result : null;
        } catch (PDOException $e) {
            error_log('Error in showQuestion: ' . $e->getMessage());
            return null;
        }
    }
    
    public function deletequestion(int $id_question): bool
    {
        $sql = "DELETE FROM questions WHERE id_question = :id_question";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id_question', $id_question, PDO::PARAM_INT);
            $query->execute();

            return $query->rowCount() > 0;
        } catch (PDOException $e) {
            error_log('Error in deletequestion: ' . $e->getMessage());
            return false;
        }
    }

    public function trierquestion($critere, $ordre = 'ASC') {

        $db = config::getConnexion();
        // Liste des colonnes valides
        $colonnesValides = ['questions', 'Date_Creation', 'type'];
        
        // Nettoyer et valider le critère de tri
        $critere = trim($critere);
    
        // Valider et normaliser l'ordre
        $ordre = strtoupper(trim($ordre)) === 'DESC' ? 'DESC' : 'ASC';
    
        try {
            // Construire et exécuter la requête
            $sql = "SELECT * FROM questions ORDER BY $critere $ordre";
            $stmt = $db->prepare($sql);
            $stmt->execute();
    
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur PDO : " . $e->getMessage());
        }
    }
    

}
?>
