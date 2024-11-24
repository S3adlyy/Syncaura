<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Support Messages</title>
    <!-- Inclure Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Inclure Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Style personnalisé pour la table */
        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Styles pour les boutons */
        .btn-sm {
            font-size: 0.875rem;
            padding: 0.375rem 0.75rem;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .add-course-btn {
            margin-bottom: 15px;
            background-color: #28a745;
            color: white;
            font-size: 16px;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .add-course-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">Client Support Messages</h1>
            <button class="add-course-btn" onclick="window.location.href='add_msg.php'">
                <i class="fa fa-plus" style="color: white;"></i> Ajouter un message
            </button>

            <!-- Read Messages -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">All Messages</h6>
                </div>
                <div class="card-body">
                    <?php
                    // Include database connection
                    include 'C:\xampp\htdocs\Crud Doudou\doudou\config.php';

                    try {
                        // Establish database connection
                        $pdo = new PDO('mysql:host=localhost;dbname=contact', 'root', '');
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Fetch messages from database
                        $stmt = $pdo->query("SELECT * FROM gcontacte");
                        $messages = $stmt->fetchAll();

                        if (count($messages) > 0) {
                            echo '<table class="table table-bordered table-striped">';
                            echo '<thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Message</th><th>Actions</th></tr></thead><tbody>';
                            foreach ($messages as $message) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($message['id']) . '</td>';
                                echo '<td>' . htmlspecialchars($message['name']) . '</td>';
                                echo '<td>' . htmlspecialchars($message['email']) . '</td>';
                                echo '<td>' . htmlspecialchars($message['message']) . '</td>';
                                echo '<td>
                                    <form action="update_msg.php" method="POST" style="display:inline-block;">
                                        <input type="hidden" name="id" value="' . htmlspecialchars($message['id']) . '">
                                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                    </form>
                                    <button onclick="confirmDelete(' . $message['id'] . ')" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </td>';
                                echo '</tr>';
                            }
                            echo '</tbody></table>';
                        } else {
                            echo '<p>No messages found.</p>';
                        }
                    } catch (Exception $e) {
                        echo '<p>Error: ' . htmlspecialchars($e->getMessage()) . '</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Confirmation before deleting a message
    function confirmDelete(id) {
        if (confirm("Are you sure you want to delete this message?")) {
            window.location.href = 'delete_message.php?id=' + id;
        }
    }
</script>

</body>
</html>
