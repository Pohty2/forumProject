<?php
require_once('includes/class.phpmailer.php');

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->CharSet="UTF-8";
$mail->SMTPSecure = 'tls';
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->Username = 'pohtianyong@gmail.com';
$mail->Password = 'Omens888';
$mail->SMTPAuth = true;

$mail->From = 'pohtianyong@gmail.com';
$mail->FromName = 'Admin';
$mail->AddAddress('pohtianyong@hotmail.com');
$mail->AddReplyTo('pohtianyong@hotmail.com', 'Password Reset');

$mail->IsHTML(true);
$mail->Subject    = "Password Reset";
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!";
$mail->Body    = "Your new password is ";

if(!$mail->Send())
{
    echo "Mailer Error: " . $mail->ErrorInfo;
}
else
{
    echo "Message sent!";
}
?>