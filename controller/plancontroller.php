<?php
include(__DIR__ . "../../configgg.php");

class PlanController
{
    public function getPlanByName($nom) {
        $query = "SELECT * FROM plan WHERE nom = :nom";
        $db = config::getConnexion();  // Directly get the database connection
        $stmt = $db->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Returns the plan if it exists, or false if not
    }
    
    public function addPlan($nom)
    {
        $date_plan = date('Y-m-d H:i:s'); // Set the current date as the date_plan
        $sql = "INSERT INTO plan (nom, date_plan) VALUES (:nom, :date_plan)";
        $db = config::getConnexion();
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute(['nom' => $nom, 'date_plan' => $date_plan]);
        } catch (Exception $e) {
            if ($e->getCode() == 23000) {  // Integrity constraint violation (duplicate entry)
                echo "Error: Plan name already exists. Please choose a different name.";
            } 
            else {
                // Handle other errors
                echo "Error: " . $e->getMessage();
            }        
        }

    }
 // This function will fetch plans from the database without pagination
        public function listPlansALL()
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
 // This function will fetch plans from the database with pagination
 public function listPlans($offset = 0, $limit = 7)
 {
     $sql = "SELECT * FROM plan LIMIT :limit OFFSET :offset";
     $db = config::getConnexion();
     try {
         // Prepare the query
         $stmt = $db->prepare($sql);
         // Bind parameters
         $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
         $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
         // Execute the query
         $stmt->execute();
         // Fetch all results
         return $stmt->fetchAll();
     } catch (Exception $e) {
         die('Error: ' . $e->getMessage());
     }
 }

 // This function will return the total count of plans
 public function getTotalPlans()
 {
     $sql = "SELECT COUNT(*) AS total FROM plan";
     $db = config::getConnexion();
     try {
         $result = $db->query($sql);
         $row = $result->fetch();
         return $row['total'];
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
        $db->beginTransaction();

        // First, delete the tasks associated with the plan_name
        $deleteTasksSql = "DELETE FROM tachee WHERE plan_name = :planName";
        $stmt = $db->prepare($deleteTasksSql);
        $stmt->execute(['planName' => $planName]);

        // Now, delete the plan itself
        $deletePlanSql = "DELETE FROM plan WHERE nom = :planName";
        $stmt = $db->prepare($deletePlanSql);
        $stmt->execute(['planName' => $planName]);

        $db->commit();

    } catch (Exception $e) {
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

public function getTotalTasksByPlanName($planName)
{
    try {
        $pdo = config::getConnexion();
        // Use plan_name to count tasks
        $query = $pdo->prepare("SELECT COUNT(*) AS total FROM tachee WHERE plan_name = :planName");
        $query->execute(['planName' => $planName]);
        $result = $query->fetch();
        return $result['total'];
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

/////////////////////
// Fetch tasks with pagination
public function listTasks($offset = 0, $limit = 7) {
    $sql = "SELECT * FROM tachee LIMIT :limit OFFSET :offset";
    $db = config::getConnexion();
    try {
        // Prepare the query
        $stmt = $db->prepare($sql);
        // Bind parameters
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        // Execute the query
        $stmt->execute();
        // Fetch all results
        return $stmt->fetchAll();
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}
// Get the total number of tasks
public function getTotalTasks() {
    $sql = "SELECT COUNT(*) AS total FROM tachee";
    $db = config::getConnexion();
    try {
        $result = $db->query($sql);
        $row = $result->fetch();
        return $row['total'];
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}
//////////////////////////
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
//////////////////filter
public function listPlansWithFilter($offset = 0, $limit = 7, $nameFilter = '', $dateFilter = '')
{
    // Prepare the base SQL query
    $sql = "SELECT * FROM plan WHERE 1";

    // Add filter conditions if provided
    if (!empty($nameFilter)) {
        $sql .= " AND nom LIKE :nameFilter";
    }
    if (!empty($dateFilter)) {
        $sql .= " AND date_plan = :dateFilter";
    }

    // Add pagination
    $sql .= " LIMIT :limit OFFSET :offset";
    
    $db = config::getConnexion();
    try {
        // Prepare the query
        $stmt = $db->prepare($sql);

        // Bind parameters for filters
        if (!empty($nameFilter)) {
            $stmt->bindParam(':nameFilter', $nameFilter, PDO::PARAM_STR);
        }
        if (!empty($dateFilter)) {
            $stmt->bindParam(':dateFilter', $dateFilter, PDO::PARAM_STR);
        }

        // Bind parameters for pagination
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

        // Execute the query
        $stmt->execute();

        // Fetch all results
        return $stmt->fetchAll();
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}

public function listTasksWithFilter($offset = 0, $limit = 7, $nameFilter = '', $dateFilter = '', $etatFilter = '')
{
    // Prepare the base SQL query
    $sql = "SELECT * FROM tachee WHERE 1";

    // Add filter conditions if provided
    if (!empty($nameFilter)) {
        $sql .= " AND nom LIKE :nameFilter";
    }
    if (!empty($dateFilter)) {
        $sql .= " AND date = :dateFilter";
    }
    if (!empty($etatFilter)) {
        $sql .= " AND etat LIKE :etatFilter";
    }

    // Add pagination
    $sql .= " LIMIT :limit OFFSET :offset";
    
    $db = config::getConnexion();
    try {
        // Prepare the query
        $stmt = $db->prepare($sql);

        // Bind parameters for filters
        if (!empty($nameFilter)) {
            $stmt->bindParam(':nameFilter', $nameFilter, PDO::PARAM_STR);
        }
        if (!empty($dateFilter)) {
            $stmt->bindParam(':dateFilter', $dateFilter, PDO::PARAM_STR);
        }
        if (!empty($etatFilter)) {
            $stmt->bindParam(':etatFilter', $etatFilter, PDO::PARAM_STR);
        }

        // Bind parameters for pagination
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

        // Execute the query
        $stmt->execute();

        // Fetch all filtered tasks
        return $stmt->fetchAll();
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}

public function getTotalFilteredTasks($nameFilter = '', $dateFilter = '', $etatFilter = '')
{
    // Prepare the base SQL query for counting tasks with filters
    $sql = "SELECT COUNT(*) FROM tachee WHERE 1";

    // Add filter conditions if provided
    if (!empty($nameFilter)) {
        $sql .= " AND nom LIKE :nameFilter";
    }
    if (!empty($dateFilter)) {
        $sql .= " AND date = :dateFilter";
    }
    if (!empty($etatFilter)) {
        $sql .= " AND etat LIKE :etatFilter";
    }

    $db = config::getConnexion();
    try {
        // Prepare the query
        $stmt = $db->prepare($sql);

        // Bind parameters for filters
        if (!empty($nameFilter)) {
            $stmt->bindParam(':nameFilter', $nameFilter, PDO::PARAM_STR);
        }
        if (!empty($dateFilter)) {
            $stmt->bindParam(':dateFilter', $dateFilter, PDO::PARAM_STR);
        }
        if (!empty($etatFilter)) {
            $stmt->bindParam(':etatFilter', $etatFilter, PDO::PARAM_STR);
        }

        // Execute the query
        $stmt->execute();

        // Fetch the count of filtered tasks
        return $stmt->fetchColumn();
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}



}
?>
