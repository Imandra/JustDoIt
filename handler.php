<?php
$t = '';
if (isset($_POST)) {
    foreach ($_POST as $k => $v) {
        $t .= $k . ": " . $v . "\r\n";
    }
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die ('Введите корректный email');
    }
    /*stored form data in a text file*/
    $f = fopen('app.txt', 'a+');
    fwrite($f, 'date: ' . date('d-m-y, H-i-s') . "\r\n");
    fwrite($f, $t . "" . "\r\n");
    fclose($f);

    /*set php.ini - НЕ ЗАБЫТЬ ЗАКОММЕНТИРОВАТЬ!!!*/
    ini_set("SMTP", "mail.interzet.ru");
    ini_set("smtp_port", "25");
    ini_set("sendmail_from", "imandra@citydom.ru");
    /*-------------------------------------------*/

    /*send mail*/
    $from = 'imandra@citydom.ru';//на хостинге адрес отправителя будет другой
    $subject = 'Тестовое письмо';//сабж письма изменить на реальный
    $subject = '=?utf-8?b?' . base64_encode($subject) . '?=';
    $headers = "Content-type: text/plain; charset=\"utf-8\"\r\n";
    $headers .= "From: <" . $from . ">\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Date: " . date('D, d M Y h:i:s O') . "\r\n";
    $message = 'Это тестовое письмо';//текст письма изменить на реальный

    mail($email, $subject, $message, $headers);

    echo 'Данные формы сохранены, письмо на адрес ' . $email . ' отправлено.';//ответ сервера
}