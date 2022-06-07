<?php session_start();
$mail=$_GET['mailid'];
$receiver = $mail;
$subject = "Interview invite";
$body = "Hi, This is to inform that you have been invited to the interview at University of Houses. ";
$sender = "From:universityofhouses@gmail.com";

if(mail($receiver, $subject, $body, $sender)){
    echo "Email sent successfully ";
}else{
    echo "Sorry, failed while sending mail!";
}
?>