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
            width: 85%;
            margin: 40px auto;
            border-collapse: collapse;
            font-family: 'Arial', sans-serif;
            background-color: #ffffff;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .cool-table th, .cool-table td {
            padding: 16px;
            text-align: left;
            color: #333;
            font-size: 14px;
            font-weight: normal;
        }

        .cool-table th {
            background-color: #4e73df;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: bold;
        }

        .cool-table td {
            background-color: #fafbfc;
            border-bottom: 1px solid #f1f1f1;
        }

        .cool-table tr:hover {
            background-color: #f1f1f1;
            transform: scale(1.02);
        }

        /* Hover animation for entire table */
        .cool-table:hover {
            transform: scale(1.02);
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
        $stmt = $this->db->prepare("SELECT u.username, m.message, m.timestamp, m.user_id
                                    FROM users u
                                    JOIN messages m ON u.id = m.user_id"); // Ensure 'user_id' is the correct column

        // Execute the query
        $stmt->execute();

        // Fetch all the results as an associative array
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Check if results exist
        if (!empty($result)) {
            echo "<table class='cool-table'>";
            echo "<tr><th>Username</th><th>Message</th><th>Timestamp</th><th>User ID</th></tr>"; // Added User ID column

            // Loop through the results and display each row
            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                echo "<td>" . htmlspecialchars($row['message']) . "</td>";
                echo "<td>" . htmlspecialchars($row['timestamp']) . "</td>";
                echo "<td>" . htmlspecialchars($row['user_id']) . "</td>"; // Displaying user_id
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
