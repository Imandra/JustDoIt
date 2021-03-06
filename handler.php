<?php
$text = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
    /*validation of the entered email address*/
    $to = $_POST['email'];
    if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
        die ('Введите корректный email');
    }

    /*send mail*/
    $from = 'postmaster@justdoitgame.ru';
    $subject = "Благодарим за подписку";
    $subject = '=?utf-8?b?' . base64_encode($subject) . '?=';
    $headers = "Content-type: text/plain; charset=\"utf-8\"\r\n";
    $headers .= "From: <" . $from . ">\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Date: " . date('D, d M Y h:i:s O') . "\r\n";
    $message = "Спасибо, что заинтересовались проектом личностного роста.\n" .
        "Надеемся, что у нас с вами сложатся отношения.\n" .
        "Мы свяжемся с вами в ближайшее время.\n\n--\nС уважением,\nКоманда проекта \"Просто Сделай\"";
    if (mail($to, $subject, $message, $headers))
        echo 'Информация отправлена на ваш email';

    /*stored form data in a text file*/
    foreach ($_POST as $key => $value) {
        $text .= $key . ": " . htmlspecialchars($value) . "\r\n";
    }
    $file = fopen('findings/app.txt', 'a+');
    fwrite($file, 'date: ' . date('d-m-y, H-i-s') . "\r\n");
    fwrite($file, $text . "" . "\r\n");
    fclose($file);
}