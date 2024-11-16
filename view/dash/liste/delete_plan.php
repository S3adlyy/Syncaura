<?php
// Include the database configuration
include_once '../../../model/config.php';

class Liste {
    private $db;

    public function __construct($connect) {
        $this->db = $connect;
    }

    // Method to delete a plan by ID
    public function delete($id) {
        try {
            // Prepare the SQL DELETE statement
            $stmt = $this->db->prepare("DELETE FROM plan WHERE id = :id");
            $stmt->bindParam(':id', $id);

            // Execute the statement
            $stmt->execute();
            echo "Plan deleted successfully!";
        } catch (PDOException $e) {
            // Handle errors gracefully
            echo 'Error deleting plan: ' . $e->getMessage();
        }
    }
}

// Check if 'id' is provided in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Initialize the Liste class
    $delete = new Liste($connect);

    // Call the delete method
    $delete->delete($id);

    // Redirect back to the list of plans (optional)
    header("Location: liste.php");
    exit;
} else {
    // If no id is provided, redirect back to the list
    header("Location: liste.php");
    exit;
}
?>
