<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
$Email=$_GET['mailid'];
$receiver = $Email;
$subject = "Selected!!";
$body = "Hi, This is to inform you that you have been selected for the job position at University of Houses.";
$sender = "From:universityofhouses@gmail.com";
$status="Selected";

if(mail($receiver, $subject, $body, $sender)){
    echo "Email sent successfully to $receiver";
    $query = $dbh->prepare("UPDATE tblteacher SET status='$status' WHERE Email='$Email'");
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);  
}else{
    echo "Sorry, failed while sending mail!";
}
echo '<script>alert("Done!!")</script>';
echo "<script>window.location.href ='candidate status.php'</script>";
?>