<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages Table</title>
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
        .cool-table .delete-btn {
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

        .cool-table .delete-btn:hover {
            background-color: #d32f2f;
            transform: translateY(-2px);
        }

        .cool-table .delete-btn:active {
            transform: translateY(1px);
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
include_once '../../models/chat_db/configg.php'; // Correct the path to the config file if needed

class Message {
    private $db;

    public function __construct($connect) {
        $this->db = $connect;
    }

    public function getMessages() {
        // SQL query to fetch message, timestamp, and chatroom by joining users and messages
        $stmt = $this->db->prepare("
            SELECT m.id, m.message, m.timestamp, u.chatroom 
            FROM messages m
            JOIN users u ON m.user_id = u.id
        ");
        $stmt->execute();
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        if (!empty($messages)) {
            echo "<table class='cool-table'>";
            echo "<tr><th>Message</th><th>Timestamp</th><th>Chatroom</th><th>Action</th></tr>"; // Changed User ID to Chatroom
    
            // Display each message's information in a table row
            foreach ($messages as $message) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($message['message']) . "</td>";
                echo "<td>" . htmlspecialchars($message['timestamp']) . "</td>";
                echo "<td>" . htmlspecialchars($message['chatroom']) . "</td>"; // Display chatroom instead of user_id
    
                // Add a delete button
                echo "<td>
                        <form method='POST' action=''>
                            <input type='hidden' name='message_id' value='" . $message['id'] . "'>
                            <button type='submit' name='delete_message' class='delete-btn'>Delete</button>
                        </form>
                      </td>";
                echo "</tr>";
            }
    
            echo "</table>";
        } else {
            echo "<p style='text-align: center; color: #333;'>No messages found.</p>";
        }
    }

    public function deleteMessage($messageId) {
        // SQL query to delete message by ID
        $stmt = $this->db->prepare("DELETE FROM messages WHERE id = :id");
        $stmt->bindParam(':id', $messageId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}

// Create the Message object and handle delete action
$table = new Message($connect);

// Check if the delete form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_message'])) {
    $messageId = $_POST['message_id'];  // Get the message ID from the form
    $table->deleteMessage($messageId);  // Delete the message from the database
}
?>

</body>
</html>
