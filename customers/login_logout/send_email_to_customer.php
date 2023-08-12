<?php
//email send
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

session_start();
$userEmail = $_SESSION['forget-pwd-email'];

ob_start();

/*
include 'email_to_customer.php';
$bodyCus = ob_get_contents();
*/
require_once 'email_to_customer.php';
$bodyCus = ob_get_clean();

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
$mail->addAddress($userEmail);
$mail->isHTML(true);
$mail->Subject = "Here is your password";
$mail->Body = $bodyCus;

$mail->send();

//header
header("Location: pwd_success.php");