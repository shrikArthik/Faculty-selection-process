<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['submit']))
  {
    $email=$_POST['email'];
$mobile=$_POST['mobile'];
$newpassword=md5($_POST['newpassword']);
  $sql ="SELECT Email FROM tblteacher WHERE Email=:email and MobileNumber=:mobile";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update tblteacher set Password=:newpassword where Email=:email and MobileNumber=:mobile";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
$chngpwd1-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
echo "<script>alert('Your Password succesfully changed');</script>";
echo "<script>window.location.href ='index.php'</script>";
}
else {
echo "<script>alert('Email id or Mobile no is invalid');</script>"; 
}
}

?>
<!doctype html>
<html class="no-js" lang="en">
<head>    
    <title>ERS Forgot Password</title> 
    <link rel="apple-touch-icon" href="apple-icon.png"> 
    <link rel="stylesheet" href="../vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../vendors/selectFX/css/cs-skin-elastic.css">

    <link rel="stylesheet" href="D:\software engineering\Xampp\htdocs\trms\css\styles.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

<script type="text/javascript">
function valid()
{
if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match  !!");
document.chngpwd.confirmpassword.focus();
return false;
}
return true;
}
</script>

</head>

<body class="bg-dark" style="background-image: linear-gradient(rgba(255,255,255,.1), rgba(255,255,255,.1)),url('images/password.jpg');">


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container" style="display: flex;align-items: center;justify-content: center;margin-top: 80px;">
            <div class="login-content" style="background: rgba(105, 105, 105, 0.5);padding-left: 100px;padding-right: 100px;">
                <div class="login-logo">
                    <br>
                      <h2 style="color:#000000">Faculty Recuritment System </h2>
                    <hr  color="red"/>
                </div>
                <div class="login-form">
                    <form action="" method="post" name="chngpwd" onSubmit="return valid();">
                        
<div class="form-group">
<label>Email Address</label>
<input type="email" class="form-control"  required="" name="email">
</div>

<div class="form-group">
<label>Mobile Number</label>
<input type="text" class="form-control"  name="mobile" required="true">
</div>
                        
<div class="form-group">
<label>Password</label>
<input class="form-control" type="password" name="newpassword" required="true"/>
</div>

<div class="form-group">
<label>Confirm Password</label>
<input class="form-control" type="password" name="confirmpassword" required="true" />
</div>

<button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30" name="submit">Reset</button>
<br><br>

<div class="checkbox">
<label class="pull-left">
 <a href="index.php"><h6 style="color: #00008B">Sign in</h6></a>
 </label>
</div>
</form>

</div>
</div>
</div>
</div>


    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <script src="../vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/main.js"></script>


</body>

</html>
