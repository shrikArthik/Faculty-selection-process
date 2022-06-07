<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
$Email=$_GET['maillid'];
$receiver = $Email;
$subject = "Sorry Better luck next time!!";
$body = "Hi, This is to inform you that your application have been rejected for the job position at University of Houses.";
$sender = "From:universityofhouses@gmail.com";
$status="Rejected";
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

