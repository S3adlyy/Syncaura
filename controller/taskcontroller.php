<?php
/*
include(__DIR__ . '/../config.php');

class TaskController
{
    // Add Task
    public function addTask($nom, $etat, $plan_id) {
        $date = date('Y-m-d'); // Automatically set the current date
        $sql = "INSERT INTO tachee (nom, date, etat, plan_id) VALUES (:nom, :date, :etat, :plan_id)";
        $db = config::getConnexion();
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute(['nom' => $nom, 'date' => $date, 'etat' => $etat, 'plan_id' => $plan_id]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // List Tasks
    public function listTasks() {
        $sql = "SELECT * FROM tachee";
        $db = config::getConnexion();
        try {
            $result = $db->query($sql);
            return $result->fetchAll();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // List Tasks by Plan ID
    public function listTasksByPlan($plan_id) {
        $sql = "SELECT * FROM tachee WHERE plan_id = :plan_id";
        $db = config::getConnexion();
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute(['plan_id' => $plan_id]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Modify Task (only the name and status can be changed)
    public function modifyTask($id, $nom, $etat) {
        $sql = "UPDATE tachee SET nom = :nom, etat = :etat WHERE id = :id";
        $db = config::getConnexion();
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute(['id' => $id, 'nom' => $nom, 'etat' => $etat]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Delete Task
    public function deleteTask($id) {
        $sql = "DELETE FROM tachee WHERE id = :id";
        $db = config::getConnexion();
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute(['id' => $id]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
?>
*/