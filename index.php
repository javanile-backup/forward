<?php

require_once __DIR__.'/vendor/autoload.php';

$config = require_once 'config.php';

if (empty($config['Secret'])) {
    die("Missing secret passphrase on configuration file.");
}

if (empty($headers['To'])) {
    die("Missing or empty 'To:' header.\n");
}

$headers = getallheaders();

if (empty($headers['To'])) {
    die("Missing or empty 'To:' header.\n");
}


$to = "";

#var_dump();

#echo "Ciao";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$email = new PHPMailer();
$email->setFrom($config['From'], $config['Name']);
$email->Subject   = 'Message Subject';
$email->Body      = 'Ciao';
$email->addAddress($headers['To']);

$file_to_attach = 'PATH_OF_YOUR_FILE_HERE';

#$email->addAttachment( $file_to_attach , 'NameOfFile.pdf' );

try {
    if ($email->send()) {
        die('Message successful sent.');
    } else {
        die('Problem to send message.');
    }
} catch (Exception $error) {
    die($error->getMessage());
}

