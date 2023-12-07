<?php

require_once('phpmailer/class.phpmailer.php'); //memanggil library php mailernya

 

 

define('GUSER', 'username email');  //username email

define('GPWD', 'password email'); // password email

 

function smtpmailer($to, $from, $from_name, $subject, $body) {

global $error;

$mail = new PHPMailer();

$mail->IsSMTP();

$mail->SMTPDebug = 2;  // untuk memunculkan pesan error /debug di layar

$mail->SMTPAuth = true;  // authentifikasi smtp enable atau disable

$mail->SMTPSecure = 'ssl atau di kosongkas jika none'; // secure transfer membutuhkan authentifikasi dari mail server

$mail->Host ='hostname email'; // masukkan nama host email “diawal ssl://”

$mail->Port = nomer port; //port secure ssl email

$mail->Username = 'username email'; //username email

$mail->Password = 'password email'; //password email

$mail->SetFrom($from, $from_name);

$mail->Subject = $subject;

$mail->Body = $body;

$mail->AddAddress($to);

if(!$mail->Send()) {

$error = 'Mail error: '.$mail->ErrorInfo;

return false;

} else {

$error = 'Message sent!';

return true;

}

}

smtpmailer('email tujuan', 'email pengirim', 'nama pengirm', 'header email', 'isi email'); // scrip kirim email
?>