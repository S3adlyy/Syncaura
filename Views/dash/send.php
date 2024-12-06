<?php
// Include PHPMailer files
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $recipient = $_POST['recipient'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Create an instance of PHPMailer
    $mail = new PHPMailer(true);

    try {
        //Server settings
      //  $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                        //SMTP server (for Gmail)
        $mail->SMTPAuth   = true;                                    //Enable SMTP authentication
        $mail->Username   = 'sayari.rayen38@gmail.com';                  //SMTP username (your email)
        $mail->Password   = 'kgqo ltgb jpaf fpvp';                            //SMTP password (your email password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;             //Enable implicit TLS encryption
        $mail->Port       = 465;                                     //TCP port to connect to

        //Recipients
        $mail->setFrom('sayari.rayen38@gmail.com', 'syncaura');  // Set from email (your email)
        $mail->addAddress($recipient);  // Add recipient from the form input
        $mail->addReplyTo('sayari.rayen38@gmail.com', 'syncaura');  // Set reply-to address

        //Content
        $mail->isHTML(true);                                     //Set email format to HTML
        $mail->Subject = $subject;                               //Set the subject
        $mail->Body    = $message;                               //Set the body message
        $mail->AltBody = strip_tags($message);                   //Plain text version for non-HTML email clients
        //Send the email
        $mail->send();
        echo 'Message has been sent successfully!';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: white;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 100%;
            max-width: 600px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            font-size: 14px;
            color: #555;
        }
        input[type="email"],
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }
        textarea {
            resize: vertical;
        }
        input[type="submit"] {
            background-color:blue;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
            font-size: 16px;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #00080;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
    </style>
    
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="styles.css" rel="stylesheet">
    <link rel="stylesheet" href="min.css">

    <style>
        /* Centering the table and making the link aligned to the top left */
        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            height: calc(100vh - 100px); /* Adjust the height to keep the table vertically centered */
        }

        table {
            margin-top: 20px; /* Space between link and table */
            width: 80%; /* Adjust the table width as needed */
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

      
    </style>
</head>
<body>
    <div class="container">
        <h1>Send Email</h1>
        <form action="send.php" method="POST">
            <label for="recipient">Recipient Email:</label><br>
            <input type="email" id="recipient" name="recipient" required><br>

            <label for="subject">Subject:</label><br>
            <input type="text" id="subject" name="subject" required><br>

            <label for="message">Message:</label><br>
            <textarea id="message" name="message" rows="5" required></textarea><br>

            <input type="submit" value="Send Email">
            <br>
            
           <button><a href="listPack.php">Back to list</a></button>

        </form>
    </div>

</body>
</html>
