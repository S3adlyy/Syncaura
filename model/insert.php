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

public function getUsers() {
    try {
        $stmt = $this->db->prepare("SELECT * FROM plan");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($users)) {
            echo "<table border='1'>";
            echo "<tr>";

            // Display table headers
            foreach (array_keys($users[0]) as $column) {
                echo "<th>" . htmlspecialchars($column) . "</th>";
            }
            echo "<th>Action</th>";
            echo "</tr>";

            // Display table rows
            foreach ($users as $user) {
                echo "<tr>";
                foreach ($user as $value) {
                    echo "<td>" . htmlspecialchars($value) . "</td>";
                }
                // Add a delete link with the user's ID
                echo "<td><a href='delete_plan.php?id=" . $user['id'] . "' onclick='return confirm(\"Are you sure you want to delete this plan?\")'>Delete</a></td>";

                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No users found.</p>";
        }
    } catch (PDOException $e) {
        echo 'Problem: ' . $e->getMessage();
    }
}
}
// Initialize the Liste class
$add = new Liste($connect);
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input
    $name = htmlspecialchars($_POST["name"]);
    $date = date('Y-m-d H:i:s'); // Get the current date and time in a standard format
    
    // Call the insert method
    $add->insert($name, $date);
}

?>
