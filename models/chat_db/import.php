<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Table</title>
    <style>
    .cool-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    font-family: Arial, sans-serif;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background-color: #f8f9fc;
    border-radius: 8px;
    overflow: hidden;
}

    .cool-table th, .cool-table td {
    padding: 12px;
    text-align: left;
}

    .cool-table th {
    background-color: #4e73df;
    color: white;
    font-weight: bold;
    text-transform: uppercase;
}

    .cool-table td {
    background-color: #ffffff;
    color: #333;
    border-bottom: 1px solid #dddddd;
}

    .cool-table tr:hover td {
    background-color: #f1f1f1;
}

    .cool-table .delete-btn {
    background-color: #e74a3b;
    color: white;
    border: none;
    padding: 6px 12px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

    .cool-table .delete-btn:hover {
    background-color: #c0392b;
}

   </style>
</head>
<body>
<?php
include_once 'config.php';

class Import {
    private $db;

    public function __construct($connect) {
        $this->db = $connect;
    }

    public function getUsers() {
        $stmt = $this->db->prepare("SELECT * FROM users");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($users)) {
            echo "<table class='cool-table'>";
            echo "<tr>";

            // Display table headers
            foreach (array_keys($users[0]) as $column) {
                echo "<th>" . htmlspecialchars($column) . "</th>";
            }
            echo "<th>Action</th>";
            echo "</tr>";

            // Display each user's information in a table row
            foreach ($users as $user) {
                echo "<tr>";
                foreach ($user as $value) {
                    echo "<td>" . htmlspecialchars($value) . "</td>";
                }
                // Add delete button with user ID
                echo "<td><form method='POST' action=''>
                        <input type='hidden' name='user_id' value='" . $user['id'] . "'>
                        <button type='submit' name='delete_user' class='delete-btn'>Delete</button>
                      </form></td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No users found.";
        }
    }

    public function deleteUser($userId) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}

//delete action
$table = new Import($connect);
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_user'])) {
    $userId = $_POST['user_id'];
    $table->deleteUser($userId);
}
?>
</body>
</html>
