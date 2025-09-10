
<?php
// Check if the form was submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize and get the form data
    $name = filter_var(trim($_POST["name"]), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = filter_var(trim($_POST["subject"]), FILTER_SANITIZE_STRING);
    $message = trim($_POST["message"]);

    // Set the recipient email address
    $recipient = "staudt5292@gmail.com";

    // Set the email headers
    $headers = "From: " . $name . " <" . $email . ">\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-type: text/plain; charset=UTF-8\r\n";

    // Construct the email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Subject: $subject\n\n";
    $email_content .= "Message:\n$message\n";

    // Send the email
    if (mail($recipient, $subject, $email_content, $headers)) {
        // Redirect to a thank you page or display a success message
        header("Location: thank_you.html");
        exit;
    } else {
        // Display an error message if the email failed to send
        echo "Oops! Something went wrong, and we couldn't send your message.";
    }

} else {
    // Not a POST request, so show an error
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
?>
