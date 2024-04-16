<?php
require "vendor/autoload.php"; // Adjust the path as per your setup
include "smtp/PHPMailerAutoload.php";
// Create PDF content
$html = "<html><body><h1>Hello, World!</h1></body></html>";
// Initialize Dompdf
$dompdf = new Dompdf\Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper("A4", "portrait");
$dompdf->render();
// Get the PDF content
$pdfContent = $dompdf->output();
// Initialize PHPMailer
$mail = new PHPMailer(true);
try {
    // Server settings
    $mail->IsSMTP(); //Sets Mailer to send message using SMTP
    $mail->Host = "smtp.gmail.com"; //Sets the SMTP hosts of your Email hosting, this for Godaddy
    $mail->Port = "587"; //Sets the default SMTP server port
    $mail->SMTPAuth = true;
    $mail->CharSet = "UTF-8";
    $mail->Username = ""; //Sets SMTP username
    $mail->Password = ""; //Sets SMTP password
    $mail->SMTPSecure = "tls"; //Sets connection prefix. Options are "", "ssl" or "tls"
    $mail->From = ""; //Sets the From email address for the message
    $mail->FromName = "Testing"; //Sets the From name of the message
    $mail->WordWrap = 50;
    $mail->addAddress("youremail", "yourname"); //Sets word wrapping on the body of the message to a given number of characters
    
    
    // Attach PDF
    $mail->addStringAttachment($pdfContent, "ticket.pdf");
    // Content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = "Congratulation ,Email Send Successfully";
    $mail->Body = "<p>Please download Pdf </p>";
    // Send email
    $mail->send();
    echo "Congratulation ,Email Send Successfully";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
