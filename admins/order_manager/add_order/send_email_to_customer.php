<?php
//email send
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

session_start();

$userId = $_SESSION['send-email-to-user'];
$userEmail = "";
include_once("../../../connect/open.php");
$emailSql = "SELECT email FROM customers WHERE id = '$userId'";
$emails = mysqli_query($connect, $emailSql);
foreach ($emails as $email) {
    $userEmail = $email['email'];
}

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
$mail->Subject = "[Beautiful House] Thank you for your purchase!";
$mail->Body = $bodyCus;

$mail->send();

//header
header("Location: ../success.php");