<?php
// Importing the database configuration
include_once 'config.php';

class Liste {
    private $db;

    public function __construct($connect) {
        $this->db = $connect;
    }

    public function insert($name, $date) {
        try {
            // Prepare the SQL statement
            $stmt = $this->db->prepare("INSERT INTO plan (nom, date_plan) VALUES (:nom, :date_plan)");
            $stmt->bindParam(':nom', $name);
            $stmt->bindParam(':date_plan', $date);
            
            // Execute the statement
            $stmt->execute();
            echo "Task added successfully!";
        } catch (PDOException $e) {
            // Handle errors gracefully
            echo 'Error adding task: ' . $e->getMessage();
        }
    }
}

// Initialize the Liste class
$add = new Liste($connect);

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input
    $name = htmlspecialchars($_POST["name"]);
    $date = date('Y-m-d H:i:s'); // Get the current date and time in a standard format
    
    // Call the insert method
    $add->insert($name, $date);
    // Redirect to the todo page after insertion
    header("Location: ../view/front/todo/todo.php");
    exit();
}
?>
