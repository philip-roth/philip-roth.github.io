<?php
// Set your email address here
$to = "philip.roth@th-koeln.de";

// Collect POST data and sanitize
$name = strip_tags(trim($_POST["name"] ?? ''));
$email = filter_var(trim($_POST["email"] ?? ''), FILTER_SANITIZE_EMAIL);
$message = trim($_POST["message"] ?? '');

// Simple validation
if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo "Bitte füllen Sie das Kontaktformular vollständig aus.";
    exit;
}

// Email subject and content
$subject = "Neue Anfrage von $name";
$email_content = "Name: $name\n";
$email_content .= "Email: $email\n\n";
$email_content .= "Anfrage:\n$message\n";

// Email headers
$headers = "From: $name <$email>";

// Send the email
if (mail($to, $subject, $email_content, $headers)) {
    echo "Vielen Dank! Ihre Anfrage wurde abgeschickt.";
} else {
    http_response_code(500);
    echo "Oops! Etwas ist schiefgelaufen.";
}
?>
