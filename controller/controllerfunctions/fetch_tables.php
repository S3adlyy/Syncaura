<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    </style>
</head>
<body>
<?php
include_once '../../models/chat_db/config.php';

class Fetch {

    private $db;

    public function __construct($connect) {
        $this->db = $connect;
    }

    public function getAll() {
        // Prepare the SQL query with a JOIN between users and messages
        $stmt = $this->db->prepare("
            SELECT u.username, u.chatroom, m.message, m.timestamp
            FROM users u
            JOIN messages m ON u.id = m.user_id
        "); // Added 'chatroom' to SELECT
        
        // Execute the query
        $stmt->execute();
        
        // Fetch all the results as an associative array
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Check if results exist
        if (!empty($result)) {
            echo "<table class='cool-table'>";
            echo "<tr><th>Username</th><th>Chatroom</th><th>Message</th><th>Timestamp</th></tr>"; // Added Chatroom column header
        
            // Loop through the results and display each row
            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                echo "<td>" . htmlspecialchars($row['chatroom']) . "</td>"; // Displaying Chatroom
                echo "<td>" . htmlspecialchars($row['message']) . "</td>";
                echo "<td>" . htmlspecialchars($row['timestamp']) . "</td>";
                echo "</tr>";
            }
        
            echo "</table>";
        } else {
            echo "<p>No messages found.</p>";
        }
    }
}
?>
</body>
</html>
