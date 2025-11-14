<?php
// Receiving email (for reference, won't actually send locally)
$receiving_email_address = 'dorrylmbula2022@gmail.com';

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status'=>'error','message'=>'Invalid request method']);
    exit;
}

// Get form data
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$subject = trim($_POST['subject'] ?? 'New message from website');
$message = trim($_POST['message'] ?? '');

// Validate required fields
if (!$name || !$email || !$message) {
    echo json_encode(['status'=>'error','message'=>'Please fill in all required fields']);
    exit;
}

// Since this is localhost, we will just return success
echo json_encode([
    
    'message' => 'Message sent successfully! ✅'
]);
exit;
?>
