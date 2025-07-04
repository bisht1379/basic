<?php

// header("Access-Control-Allow-Origin: *"); // Allow any origin (unsafe for production)
// header("Access-Control-Allow-Methods: POST");
// header("Access-Control-Allow-Headers: Content-Type");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';



if ($_SERVER["REQUEST_METHOD"] === "POST") 
{
    
    $name    = htmlspecialchars($_POST['name']);
    $email   = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp3.netcore.co.in';         
        $mail->SMTPAuth   = true;
        $mail->Username   = 'softmail@ccscomputers.co.in';         
        $mail->Password   = 'Cc$45oMs';       
        $mail->SMTPSecure = 'tls';                     
        $mail->Port       = 587;
        
        $mail->setFrom('softmail@ccscomputers.co.in', 'AItech');
        $mail->addReplyTo($email, $name);                                
        $mail->addAddress('nbisht@ccscomputers.co.in', ' Narender');  
        $mail->isHTML(true);
        $mail->Subject = 'New Message from Contact Form';
       $mail->Body = '
  <div style="font-family: Arial, sans-serif; max-width: 600px; margin: auto; border: 1px solid #ddd; padding: 20px; background-color: #f9f9f9;">
    <h2 style="text-align: center; color: #2c3e50;">New Contact Form Submission</h2>
    <table style="width: 100%; font-size: 16px; border-collapse: collapse;">
      <tr>
        <td style="padding: 8px; border-bottom: 1px solid #ccc;"><strong>Name:</strong></td>
        <td style="padding: 8px; border-bottom: 1px solid #ccc;">' . htmlspecialchars($name) . '</td>
      </tr>
      <tr>
        <td style="padding: 8px; border-bottom: 1px solid #ccc;"><strong>Email:</strong></td>
        <td style="padding: 8px; border-bottom: 1px solid #ccc;">' . htmlspecialchars($email) . '</td>
      </tr>
      <tr>
        <td style="padding: 8px; vertical-align: top;"><strong>Message:</strong></td>
        <td style="padding: 8px;">' . nl2br(htmlspecialchars($message)) . '</td>
      </tr>
    </table>
    <p style="font-size: 12px; color: #888; text-align: center; margin-top: 20px;">This message was sent from your  AItech website contact form.</p>
  </div>
';

if ($mail->send()) {
    // Save to CSV
    $csvData = [
        date("Y-m-d H:i:s"),
        $name,
        $email,
        str_replace(["\r", "\n"], [" ", " "], $message)
    ];

    $fp = fopen('messages.csv', 'a');
    if (filesize('messages.csv') === 0) {
        fputcsv($fp, ['Date', 'Name', 'Email', 'Message']);
    }
    fputcsv($fp, $csvData);
    fclose($fp);

    echo "✅ Message sent ";

    // 📨 Send confirmation email to user
    $confirmation = new PHPMailer(true);
    $confirmation->isSMTP();
    $confirmation->Host       = 'smtp3.netcore.co.in';
    $confirmation->SMTPAuth   = true;
    $confirmation->Username   = 'softmail@ccscomputers.co.in';
    $confirmation->Password   = 'Cc$45oMs';
    $confirmation->SMTPSecure = 'tls';
    $confirmation->Port       = 587;

    $confirmation->setFrom('softmail@ccscomputers.co.in', 'AItech');
    $confirmation->addAddress($email, $name);
    $confirmation->isHTML(true);
    $confirmation->Subject = "Thank you for contacting AItech";

    $confirmation->Body = '
    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: auto; border: 1px solid #ddd; padding: 20px; background-color: #f9f9f9;">
      <h2 style="text-align: center; color: #2c3e50;">Thank You, ' . htmlspecialchars($name) . '!</h2>
      <p style="font-size: 16px;">We have received your message and will get back to you shortly.</p>
      <hr>
      <p><strong>Your Message:</strong></p>
      <p style="font-style: italic; background: #eee; padding: 10px;">' . nl2br(htmlspecialchars($message)) . '</p>
      <p style="font-size: 14px; color: #888;">- AItech Team</p>
    </div>
    ';

    $confirmation->send(); // send confirmation email
}


    } catch (Exception $e) {
        // echo "❌ Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>


