<?php
//email send
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


ob_start();

/*
include 'email_to_admin.php';
$bodyAdmin = ob_get_contents();
*/
require_once 'email_to_admin.php';
$bodyAdmin = ob_get_clean();

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
$mail->Subject = "Customer support letter";
$mail->Body = $bodyAdmin;

$mail->send();

//header
header("Location: ../send_success.php");