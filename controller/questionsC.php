<?php
include 'C:/xampp/htdocs/Forum/config.php';
include 'C:/xampp/htdocs/Forum/Model/questions.php';

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

    public function addquestion(questions $question): bool
    {
        $sql = "INSERT INTO questions (id_question, questions, date_creation, id, type)
                VALUES (NULL, :questions, :date_creation, :id, :type)";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'questions' => $question->getquestions(),
                'date_creation' => $question->getdate_creation()->format('Y-m-d H:i:s'),
                'id' => $question->getid(),
                'type' => $question->gettype()
            ]);
            return true;
        } catch (PDOException $e) {
            error_log('Error in addquestion: ' . $e->getMessage());
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
            $query->bindValue(':date_creation', $question->getdate_creation()->format('Y-m-d H:i:s'), PDO::PARAM_STR);
            $query->bindValue(':id', $question->getid(), PDO::PARAM_INT);
            $query->bindValue(':type', $question->gettype(), PDO::PARAM_STR);
            $query->execute();

            return $query->rowCount() > 0;
        } catch (PDOException $e) {
            error_log('Error in updatequestion: ' . $e->getMessage());
            return false;
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
}
?>
