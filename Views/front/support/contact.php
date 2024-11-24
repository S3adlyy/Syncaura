<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contact";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user inputs
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Prepare the SQL query
    $stmt = $conn->prepare("INSERT INTO gcontacte (name, email, message) VALUES (?, ?, ?)");
    if ($stmt === false) {
        die("Error in SQL prepare: " . $conn->error);
    }

    $stmt->bind_param("sss", $name, $email, $message);

    // Execute the query and check for success
    if ($stmt->execute()) {
        echo "Message successfully sent. Thank you for contacting us!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

