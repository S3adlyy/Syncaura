<?php
// Importing the database configuration
include_once 'config.php';

class Liste {
    private $db;

    public function __construct($connect) {
        $this->db = $connect;
    }

    public function insert($name, $date) {
        global $errorMessage; // Use a global variable for the error message
        try {
            // Check if the name is empty
            if (empty($name)) {
                $errorMessage = "Le nom du plan ne peut pas être vide."; // French error message
                return false;
            }

            // Prepare the SQL statement
            $stmt = $this->db->prepare("INSERT INTO plan (nom, date_plan) VALUES (:nom, :date_plan)");
            $stmt->bindParam(':nom', $name);
            $stmt->bindParam(':date_plan', $date);
            
            // Execute the statement
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            $errorMessage = 'Erreur: ' . $e->getMessage();
            return false;
        }
    }

    public function getPlans() {
        try {
            // Prepare the SQL query to fetch all plans
            $stmt = $this->db->prepare("SELECT * FROM plan");
            $stmt->execute();
            $plans = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($plans)) {
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

                foreach ($plans as $plan) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($plan['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($plan['nom']) . "</td>";
                    echo "<td>" . htmlspecialchars($plan['date_plan']) . "</td>";
                    echo "<td><a href='delete_plan.php?id=" . $plan['id'] . "' class='btn-delete' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce plan ?\")'>Supprimer</a></td>";
                    echo "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<p>Aucun plan trouvé.</p>";
            }
        } catch (PDOException $e) {
            echo 'Problème: ' . $e->getMessage();
        }
    }
}

// Initialize the Liste class
$add = new Liste($connect);

// Handle form submission to insert a new plan
$errorMessage = ""; // Initialize error message
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST["name"]);
    $date = date('Y-m-d H:i:s');

    // Call the insert method
    $isInserted = $add->insert($name, $date);
    if ($isInserted) {
        header("Location: " . $_SERVER['PHP_SELF']); // Refresh page to clear form
        exit;
    }
}
?>
<!-- Form to insert a new plan -->
<form method="POST" action="">
    <label for="name">Nom du plan:</label>
    <input type="text" name="name" id="name">
    <br>
    <!-- Display error message -->
    <?php if (!empty($errorMessage)): ?>
        <p style="color: red;"><?php echo $errorMessage; ?></p>
    <?php endif; ?>
    <input type="submit" value="Ajouter un plan" style="background-color: #355CCC; color: white; padding: 8px 12px; border: none; border-radius: 4px; cursor: pointer;">
</form><br>

<!-- Display the plans table -->
<?php
$add->getPlans();
?>
<br>

<!-- Add custom table styles -->
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
        font-size: 16px;
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
