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

    // Modified getPlans method to display the data in a table
    public function getPlans() {
        try {
            // Prepare the SQL query to fetch all plans
            $stmt = $this->db->prepare("SELECT * FROM plan");
            $stmt->execute();
            $plans = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($plans)) {
                // Display table with custom styles (adjusted to your needs)
                echo "<table class='custom-table'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Nom</th>";
                echo "<th>Date Plan</th>";
                echo "<th>Action</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                // Loop through each plan and display it in the table
                foreach ($plans as $plan) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($plan['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($plan['nom']) . "</td>";
                    echo "<td>" . htmlspecialchars($plan['date_plan']) . "</td>";
                    // Delete button with confirmation
                    echo "<td><a href='delete_plan.php?id=" . $plan['id'] . "' class='btn-delete' onclick='return confirm(\"Are you sure you want to delete this plan?\")'>Delete</a></td>";
                    echo "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<p>No plans found.</p>";
            }
        } catch (PDOException $e) {
            echo 'Problem: ' . $e->getMessage();
        }
    }
}

// Initialize the Liste class
$add = new Liste($connect);

// Handle form submission to insert new plan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input
    $name = htmlspecialchars($_POST["name"]);
    $date = date('Y-m-d H:i:s'); // Get the current date and time in a standard format
    
    // Call the insert method
    $add->insert($name, $date);
}
?>

<!-- Form to insert new plan -->
<form method="POST" action="">
    <label for="name">Plan Name:</label>
    <input type="text" name="name" id="name" required>
    <input type="submit" value="Add Plan">
</form>

<!-- Display the plans table -->
<?php
// Fetch and display plans
$add->getPlans();
?>

<!-- Add the custom table styles -->
<style>
    .custom-table {
        width: 100%;
        border-collapse: collapse;
    }

    .custom-table th, .custom-table td {
        padding: 12px 15px;
        text-align: left;
        border: 1px solid #ddd;
    }

    .custom-table th {
        background-color: #355CCC;
        color: white;
        font-size: 16px; /* Adjusted header font size */
        font-weight: bold;
    }

    .custom-table td {
        font-size: 14px;
    }

    .btn-delete {
        color: red;
        font-weight: bold;
        text-decoration: none;
    }

    .btn-delete:hover {
        text-decoration: underline;
    }

    .custom-table td {
        white-space: nowrap;
    }
</style>
