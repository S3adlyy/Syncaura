<?php
// Database connection details
$dsn = "mysql:host=localhost;dbname=users";
$db_user = "root"; 
$db_password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['send'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Validate inputs
        if (empty($name) || empty($email) || empty($password)) {
            throw new Exception('All fields are required.');
        }

        // Connect to the database
        $connect = new PDO($dsn, $db_user, $db_password);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insert user into the database
        $stmt = $connect->prepare("INSERT INTO admins (name, email, password) VALUES (:name, :email, :password)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password); 
        $stmt->execute();

        // Redirect to login page 
        header("Location: login.php?success=1");
        exit();
    } catch (PDOException $e) {
     
        header("Location: register.php?error=" . urlencode($e->getMessage()));
        exit();
    } catch (Exception $e) {
        header("Location: register.php?error=" . urlencode($e->getMessage()));
        exit();
    }
}
?>
