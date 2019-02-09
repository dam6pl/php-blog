<?php

$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

if ($name && $email && $message) {
    $messageInfo = 'Dane wiadomości: ' . PHP_EOL
        . 'Data: ' . date('d.m.y, H:m:s') . PHP_EOL
        . "Imię: {$name}" . PHP_EOL
        . "Email: {$email}" . PHP_EOL
        . "Numer telefonu: {$phone}" . PHP_EOL
        . "Wiadomość: {$message}" . PHP_EOL . PHP_EOL;

    echo @file_put_contents(
        MAILS_DIR . '/' . $email . '.txt',
        $messageInfo,
        FILE_APPEND
    );
}