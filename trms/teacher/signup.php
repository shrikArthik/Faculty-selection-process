<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

//code for Signp
if(isset($_POST['submit'])) 
  {
    $fnameErr = $emailErr = $phoneErr = $passErr = "";
    $fname=$_POST['fname'];
    $emailid=$_POST['emailid'];
    $phoneno=$_POST['mobileno'];
    $pass = $_POST['password'];
    $password=md5($_POST['password']);

    
    $number = preg_match('@[0-9]@', $pass);
    $uppercase = preg_match('@[A-Z]@', $pass);
    $lowercase = preg_match('@[a-z]@', $pass);
    $specialChars = preg_match('@[^\w]@', $pass);
    
    if(strlen($pass) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) 
        $passErr = "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
    else 
    {
        if (!preg_match("/^[a-zA-Z-' ]*$/",$fname))
            $fnameErr = "Only letters and white space allowed";
        else
        {
            if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $emailid)) 
                $emailErr = "Invalid email format";
            else
            {
                if(!preg_match('/^[0-9]{10}+$/', $phoneno)) 
                $phoneErr="Enter Phone Number with correct format";
    else{
    $query =$dbh->prepare("SELECT ID  from  tblteacher where Email='$emailid' ||  MobileNumber='$phoneno'");
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);    

    if($query->rowCount() > 0)
{
echo "<script>alert('Email id or Mobile no already registered with another account.');</script>";
echo "<script type='text/javascript'> document.location ='signup.php'; </script>";
} 
else {  

$sql="insert into tblteacher(Name,Email,MobileNumber,password)values(:fname,:emailid,:phoneno,:password)";
$query=$dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':emailid',$emailid,PDO::PARAM_STR);
$query->bindParam(':phoneno',$phoneno,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->execute();
$LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
$receiver =  $emailid;
$subject = "Sucessful registeration";
$body = "Thank you for registering at University of Houses!!";
$sender = "From:universityofhouses@gmail.com";

if(mail($receiver, $subject, $body, $sender))
    echo "Email sent successfully to $receiver";
else
    echo "Sorry, failed while sending mail!";

echo '<script>alert("Registered succesfully")</script>';
echo "<script>window.location.href ='index.php'</script>";
}   
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

}
}}}}
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

?>
    
<!doctype html>
<html class="no-js" lang="en">
<head>
    
    <title>UOH Login</title>   
    <link rel="apple-touch-icon" href="apple-icon.png"> 
    <link rel="stylesheet" href="../vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="css\styles.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <style>
.error {color: #FF0000;}
</style>
</head>

<body class="bg-dark" style=" background-image: linear-gradient(rgba(255,255,255,.0), rgba(255,255,255,.0)),url('images/signup.jpeg');">

    <div class="sufee-login d-flex align-content-center flex-wrap" >
        <div class="container"style="display: flex;align-items: center;justify-content: center;margin-top: 60px;">
            <div class="login-content" style="background: rgba(105, 105, 105, 0.5);padding-left: 100px;padding-right: 100px;">
                <div class="login-logo">
                    <br>
                     <h2 style="color:black;font-weight:bold">Applicant Registration </h2>
                    <hr  color="red"/>
                </div>
                <div class="login-form">
                    <form action="" method="post" name="login">
                        
                        <div class="form-group">
                            <h6 style="font-weight: bolder;"><label>Full Name</label><span class="error">  *</span></h6>
                            <input type="text" class="form-control" placeholder="Full Name" required="true" name="fname">
                            <span class="error"><?php echo $fnameErr;?></span>
                        </div>

                           <div class="form-group">
                           <h6 style="font-weight: bolder;"><label>Email Id</label><span class="error">  *</span></h6>
                            <input type="email" class="form-control" placeholder="Email id" required="true" name="emailid">
                            <span class="error"><?php echo $emailErr;?></span>
                        </div> 

                           <div class="form-group">
                           <h6 style="font-weight: bolder;"><label>Mobile Number</label><span class="error">  *</span></h6>
                            <input type="text" class="form-control" placeholder="Mobile Number" maxlength="10" pattern="[0-9]{10}" title="10 numeric characters only"  required="true" name="mobileno">
                            <span class="error"><?php echo $phoneErr;?></span>
                        </div> 
                            
                            <div class="form-group">
                            <h6 style="font-weight: bolder;"><label>Password</label><span class="error">  *</span></h6>
                                <input type="password" class="form-control" placeholder="Password" name="password" required="true">
                                <span class="error"><?php echo $passErr;?></span>
                        </div>
                          <br>
                                <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-20" name="submit">Sign Up</button>
                                
                                  <div class="checkbox">
                                    <label class="pull-left"><br>
                                <a href="../index.php"><h7 style="color: #3D0C02;font-weight:bold;">Back Home</h7></a>
                                    <label class="pull-right">
                                <a href="index.php" style="padding-left: 250px"><h7 style="color: #3D0C02;font-weight:bold;">Already Registered | Login Here</h7></a>
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
