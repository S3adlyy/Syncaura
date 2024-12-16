<?php
// Include necessary files (e.g., database connection, mailer)
$dsn = "mysql:host=localhost;dbname=users";  // Replace with your database name
$db_user = "root";  // Your database username
$db_password = "";  // Your database password

// Create PDO instance
try {
    $pdo = new PDO($dsn, $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Include PHPMailer using Composer's autoload
require '../../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

// Check if email was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
        exit;
    }

    // Check if the email exists in the database
    $stmt = $pdo->prepare("SELECT id FROM client WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        // Generate a unique token for the password reset link
        $token = bin2hex(random_bytes(50)); // Create a secure token
        
        // Store the token and its expiration date (e.g., 1 hour expiration) in the database
        $expires = date('U') + 3600; // Token expires in 1 hour
        $stmt = $pdo->prepare("INSERT INTO password_resets (email, token, expires) VALUES (?, ?, ?)");
        $stmt->execute([$email, $token, $expires]);

        // Send the password reset email
        $resetLink = "http://localhost/integration3/Views/front/sign/reset-form.php?token=$token"; // URL to reset page

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp-relay.brevo.com'; // Use the correct SMTP server
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->Username = '81ae8b003@smtp-brevo.com'; // Use your email username
        $mail->Password = 'xsmtpsib-6c2a6832def1c06da7f6e4a04e7a5501d6baa80f65263bc7a74d89093ba44467-qKaZc7PSRhDQM8xI'; // Use your SMTP password
        $mail->setFrom('mohamed.erguez@gmail.com', 'syncaura');
        $mail->addAddress($email);
        $mail->Subject = 'Password Reset Request';
        $mail->Body    = "To reset your password, click the following link: $resetLink. If you did not request a password reset, please ignore this email.";

        if ($mail->send()) {
            echo "A password reset link has been sent to your email address.";
            header("Location: ../../../Views/front/sign/signin.php?");

            exit();
        } else {
            echo "Failed to send password reset email.";
            header("Location: ../../../Views/front/sign/signin.php?error=6");
        }
    } else {
        echo "No account found with that email address.";
        header("Location: ../../../Views/front/sign/signin.php?error=5"); 

    }
}
?>
