<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Table</title>
    <style>
        body {
            background-color: #e8eaf0;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .cool-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .cool-table th, .cool-table td {
            padding: 12px 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .cool-table th {
            background-color: #355ccc;
            color: white;
        }
        .cool-table tr:nth-child(even) {
            background-color: #f9f9f9;

        }
        .cool-table tr:hover {
            background-color: #f1f1f1;

        }
        .cool-table .delete-btn, .cool-table .modify-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 50px;
            cursor: pointer;
            font-size: 14px;
            text-transform: uppercase;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .cool-table .modify-btn {
            background-color: #4caf50; /* Green for modify */
        }

        .cool-table .delete-btn:hover, .cool-table .modify-btn:hover {
            background-color: #d32f2f;
            transform: translateY(-2px);
        }

        .cool-table .delete-btn:active, .cool-table .modify-btn:active {
            transform: translateY(1px);
        }

        .cool-table td input[type="hidden"] {
            display: none;
        }


        /* Additional responsiveness */
        @media (max-width: 768px) {
            .cool-table {
                width: 95%;
                margin: 20px;
            }
        }
    .modify-btn {
    background-color: #4e73df;
    color: white;
    border: none;
    padding: 10px 18px;
    border-radius: 50px;
    cursor: pointer;
    font-size: 14px;
    text-transform: uppercase;
    transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .modify-btn:hover {
    background-color: #3e63b3;
    transform: translateY(-2px);
    }

    .modify-btn:active {
    transform: translateY(1px);
    }
    </style>
</head>
<body>
<?php
include_once '../../models/chat_db/config.php';

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
    
            // Display table headers (excluding 'id')
            foreach (array_keys($users[0]) as $column) {
                if ($column !== 'id') { // Exclude 'id' column
                    echo "<th>" . htmlspecialchars($column) . "</th>";
                }
            }
            echo "<th>Action</th>"; // Add 'Action' column
            echo "</tr>";
    
            // Display each user's information in a table row (excluding 'id')
            foreach ($users as $user) {
                echo "<tr>";
                foreach ($user as $key => $value) {
                    if ($key !== 'id') { // Exclude 'id' value
                        echo "<td>" . htmlspecialchars($value) . "</td>";
                    }
                }
                // Add Modify and Delete buttons with the 'id' in a hidden input
                echo "<td>
                        <form method='POST' action=''>
                            <input type='hidden' name='user_id' value='" . htmlspecialchars($user['id']) . "'>
                            <button type='submit' name='modify_user' class='modify-btn'>Modify</button>
                            <button type='submit' name='delete_user' class='delete-btn'>Delete</button>
                        </form>
                      </td>";
                echo "</tr>";
            }
    
            echo "</table>";
        } else {
            echo "<p style='text-align: center; color: #333;'>No users found.</p>";
        }
    }

    public function deleteUser($userId) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getUserById($userId) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUser($userId, $username) {
        $stmt = $this->db->prepare("UPDATE users SET username = :username WHERE id = :id");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}

// Instance of Import class
$table = new Import($connect);

// Handle delete action
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_user'])) {
    $userId = $_POST['user_id'];
    $table->deleteUser($userId);
}

// Handle modify action
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['modify_user'])) {
    $userId = $_POST['user_id'];
    $user = $table->getUserById($userId);

    // Display the modification form
    if ($user) {
        echo "<h2>Modify User</h2>";
        echo "<form method='POST' action=''>
                <input type='hidden' name='user_id' value='" . $user['id'] . "'>
                <label for='username'>New Username:</label>
                <input type='text' name='username' value='" . htmlspecialchars($user['username']) . "' required>
                <button type='submit' name='update_user'>Update Username</button>
              </form>";
    }
}

// Handle update action
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_user'])) {
    $userId = $_POST['user_id'];
    $newUsername = $_POST['username'];

    if ($table->updateUser($userId, $newUsername)) {
        echo "<p>User updated successfully!</p>";
    } else {
        echo "<p>Error updating user.</p>";
    }
}
?>
</body>
</html>
