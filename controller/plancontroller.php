<?php
include(__DIR__ . '/../config.php');

class PlanController
{
    // Add Plan
    public function addPlan($nom)
    {
        $date_plan = date('Y-m-d'); // Set the current date as the date_plan
        $sql = "INSERT INTO plan (nom, date_plan) VALUES (:nom, :date_plan)";
        $db = config::getConnexion();
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute(['nom' => $nom, 'date_plan' => $date_plan]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // List Plans
    public function listPlans()
    {
        $sql = "SELECT * FROM plan";
        $db = config::getConnexion();
        try {
            $result = $db->query($sql);
            return $result->fetchAll();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Modify Plan (only the name can be changed)
    public function modifyPlan($id, $nom)
    {
        $sql = "UPDATE plan SET nom = :nom WHERE id = :id";
        $db = config::getConnexion();
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute(['id' => $id, 'nom' => $nom]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Delete Plan
    public function deletePlan($id)
    {
        $sql = "DELETE FROM plan WHERE id = :id";
        $db = config::getConnexion();
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute(['id' => $id]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
/////////////jonction
    public function listTaskByid($id) {
    try {
    $pdo = config :: getConnexion();
    $query = $pdo->prepare("SELECT * FROM tachee WHERE plan_id = :id");
    $query->execute(['id' => $id]);
    return $query->fetchAll();
    } catch (PDOException $e) {
    echo $e->getMessage();
    }
}
/////////////////////
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
