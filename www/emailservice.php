<?php
use PHPMailer\PHPMailer\PHPMailer;

require './vendor/phpmailer/phpmailer/src/Exception.php';
require './vendor/phpmailer/phpmailer/src/PHPMailer.php';
require './vendor/phpmailer/phpmailer/src/SMTP.php';

$ini = parse_ini_file(__DIR__ . '/../secret/personal_params.ini', true);
$inigm = $ini['GMAIL'];

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->IsHTML(true);
$mail->Mailer = "smtp";
$mail->SMTPDebug = 0;
$mail->SMTPAuth = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port = 587;
$mail->Host = "smtp.gmail.com";
$mail->Username = $inigm['username'];
$mail->Password = $inigm['secret'];
$mail->SetFrom($inigm['username']);
$mail->AddReplyTo($inigm['username']);
$mail->Subject = $_POST['subject'];
foreach(explode(',', $_POST['email']) as $email) {
  $mail->AddAddress($email);
}
$mail->MsgHTML($_POST['body']);
if (!$mail->Send()) {
  echo "Error while sending Email.";
  var_dump($mail);
  var_dump($_POST);
} else {
  echo "Email sent successfully";
}
