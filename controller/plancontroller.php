<?php
include(__DIR__ . '/../config.php');

class PlanController
{
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

    // Modify Plan (only the name)
    public function modifyPlan($id, $newName)
    {
        $db = config::getConnexion();
    
        try {
            // Start transaction
            $db->beginTransaction();
    
            // Get the current plan name using the ID
            $currentPlanNameQuery = "SELECT nom FROM plan WHERE id = :id";
            $stmt = $db->prepare($currentPlanNameQuery);
            $stmt->execute(['id' => $id]);
            $currentPlanName = $stmt->fetchColumn();
    
            if (!$currentPlanName) {
                throw new Exception("Plan not found.");
            }
    
            // Temporarily disable foreign key checks
            $db->exec("SET FOREIGN_KEY_CHECKS=0");
    
            // Update the plan name in the plan table
            $updatePlanSql = "UPDATE plan SET nom = :newName WHERE id = :id";
            $stmt = $db->prepare($updatePlanSql);
            $stmt->execute(['newName' => $newName, 'id' => $id]);
    
            // Update tasks in the tachee table
            $updateTasksSql = "UPDATE tachee SET plan_name = :newName WHERE plan_name = :currentName";
            $stmt = $db->prepare($updateTasksSql);
            $stmt->execute(['newName' => $newName, 'currentName' => $currentPlanName]);
    
            // Re-enable foreign key checks
            $db->exec("SET FOREIGN_KEY_CHECKS=1");
    
            // Commit the transaction
            $db->commit();
        } catch (Exception $e) {
            // Rollback transaction on failure
            $db->rollBack();
            die('Error: ' . $e->getMessage());
        }
    }    

 public function deletePlan($planName)
{
    $db = config::getConnexion();
    
    try {
        // Start a transaction to ensure both deletes happen atomically
        $db->beginTransaction();

        // First, delete the tasks associated with the plan_name
        $deleteTasksSql = "DELETE FROM tachee WHERE plan_name = :planName";
        $stmt = $db->prepare($deleteTasksSql);
        $stmt->execute(['planName' => $planName]);

        // Now, delete the plan itself
        $deletePlanSql = "DELETE FROM plan WHERE nom = :planName";
        $stmt = $db->prepare($deletePlanSql);
        $stmt->execute(['planName' => $planName]);

        // Commit the transaction
        $db->commit();

    } catch (Exception $e) {
        // Rollback the transaction if an error occurs
        $db->rollBack();
        die('Error: ' . $e->getMessage());
    }
}

/////////////jonction
public function listTaskByPlanName($planName) {
    try {
        $pdo = config::getConnexion();
        // Use plan_name to filter tasks
        $query = $pdo->prepare("SELECT * FROM tachee WHERE plan_name = :planName");
        $query->execute(['planName' => $planName]);
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
public function deleteTask($taskId, $planName) {
    $sql = "DELETE FROM tachee WHERE id = :id AND plan_name = :planName";
    $db = config::getConnexion();
    try {
        $stmt = $db->prepare($sql);
        $stmt->execute(['id' => $taskId, 'planName' => $planName]);
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}

}
?>
