<?php
$text = '';
if (isset($_POST)) {
    /*validation of the entered email address*/
    $to = $_POST['email'];
    if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
        die ('Введите корректный email');
    }

    /*send mail*/
    /*$from = 'postmaster@justdoitgame.ru';
    $subject = 'Тестовое письмо';//на хостинге сабж письма изменить на реальный
    $subject = '=?utf-8?b?' . base64_encode($subject) . '?=';
    $headers = "Content-type: text/plain; charset=\"utf-8\"\r\n";
    $headers .= "From: <" . $from . ">\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Date: " . date('D, d M Y h:i:s O') . "\r\n";
    $message = 'Это тестовое письмо';//на хостинге текст письма изменить на реальный
    mail($to, $subject, $message, $headers);*/

    /*stored form data in a text file*/
    foreach ($_POST as $key => $value) {
        $text .= $key . ": " . htmlspecialchars($value) . "\r\n";
    }
    $file = fopen('findings/app.txt', 'a+');
    fwrite($file, 'date: ' . date('d-m-y, H-i-s') . "\r\n");
    fwrite($file, $text . "" . "\r\n");
    fclose($file);

    /*server response*/
    echo 'Информация отправлена на Ваш email';
}