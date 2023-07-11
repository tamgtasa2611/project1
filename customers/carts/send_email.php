<?php
//email send
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


ob_start();
include 'email_to_admin.php';
$body = ob_get_contents();

//gui email den admin
$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'tam.ad.php@gmail.com';
$mail->Password = 'gibtxtxiwrcogmfs';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

$mail->setFrom('tam.ad.php@gmail.com');
$mail->addAddress('tam.ad.php@gmail.com');
$mail->isHTML(true);
$mail->Subject = "[Admin - Beautiful House] NEW ORDER";
$mail->Body = $body;

$mail->send();

//header
header("Location: order_success.php");