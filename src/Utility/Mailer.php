<?php
namespace App\Utility;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Mailer {
    private $mailer;

    public function __construct() {
        $this->mailer = new PHPMailer(true);
        
        // Debug settings
        // $this->mailer->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
        
        // Server settings
        $this->mailer->isSMTP();
        $this->mailer->Host = 'smtp.gmail.com'; // Replace with your SMTP host
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = 'contact.indiaunbound@gmail.com'; // Replace with your email
        $this->mailer->Password = 'pmojommaeyjbxgdy'; // Replace with your app password
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mailer->Port = 587;
        
        
        // Default sender
        $this->mailer->setFrom('contact.indiaunbound@gmail.com', 'MCMS System');
    }

    public function sendWelcomeEmail($email, $userName, $role) {
        try {
            // Clear all addresses first (in case of reuse)
            $this->mailer->clearAddresses();
            
            // Recipients
            $this->mailer->addAddress($email);

            // Content
            $this->mailer->isHTML(true);
            $this->mailer->Subject = 'Welcome to MCMS - Medical Clinic Management System';
            
            // Capitalize first letter of every word in username
            $formattedName = ucwords(strtolower($userName));
            $formattedRole = ucwords(strtolower($role));
            
            // Email body
            $body = "
            <html>
            <head>
                <style>
                    body { font-family: Arial, sans-serif; }
                    .container { padding: 20px; }
                    .header { color: #D23C42; }
                    .content { line-height: 1.6; }
                    .footer { margin-top: 20px; color: #7f8c8d; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <h2 class='header'>Welcome to MCMS, {$formattedName}!</h2>
                    <div class='content'>
                        <p>Thank you for registering as a {$formattedRole} with the Medical Clinic Management System.</p>
                        <p>Your account has been successfully created and you can now access all our services.</p>
                        <p>If you have any questions or need assistance, please don't hesitate to contact our support team.</p>
                    </div>
                    <div class='footer'>
                        <p>Best regards,<br>MCMS Team</p>
                    </div>
                </div>
            </body>
            </html>
            ";
            
            $this->mailer->Body = $body;
            $this->mailer->AltBody = strip_tags(str_replace(['<br>', '</p>'], ["\n", "\n"], $body));

            return $this->mailer->send();
        } catch (Exception $e) {
            error_log("Email sending failed: " . $e->getMessage());
            return false;
        }
    }
} 