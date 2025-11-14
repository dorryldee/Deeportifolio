<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer classes
require __DIR__ . '/../assets/vendor/phpmailer/src/Exception.php';
require __DIR__ . '/../assets/vendor/phpmailer/src/PHPMailer.php';
require __DIR__ . '/../assets/vendor/phpmailer/src/SMTP.php';

// Email address to receive messages
$receiving_email_address = 'dorrylmbula2022@gmail.com';

// Validate POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit;
}

// Collect form data
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$subject = $_POST['subject'] ?? 'New message from website';
$message = $_POST['message'] ?? '';

if (!$name || !$email || !$message) {
    echo json_encode(['status' => 'error', 'message' => 'Please fill in all required fields']);
    exit;
}

$mail = new PHPMailer(true);

try {
    // Use local SMTP for XAMPP testing
    $mail->isSMTP();
    $mail->Host = '127.0.0.1';   // local SMTP
    $mail->Port = 25;            // default XAMPP sendmail port
    $mail->SMTPAuth = false;     // no authentication for local SMTP

    // Sender and recipient
    $mail->setFrom($email, $name);
    $mail->addAddress($receiving_email_address);

    // Email content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = "<strong>Name:</strong> $name<br>
                   <strong>Email:</strong> $email<br>
                   <strong>Message:</strong><br>$message";

    // Send email
    $mail->send();

    // JS expects 'OK'
    echo 'OK';
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => "Mailer Error: {$mail->ErrorInfo}"]);
}
