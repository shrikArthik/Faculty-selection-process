<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (isset($_SESSION["locked"]))
{
    $difference = time() - $_SESSION["locked"];
    if ($difference > 60)
    {
        unset($_SESSION["locked"]);
        unset($_SESSION["login_attempts"]);
    }
}
 
// In sign-in form submit button
if ($_SESSION["login_attempts"] > 2)
{
    $_SESSION["locked"] = time();
    echo "Please wait for 5 mins";
}
else
{ 
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $sql = "SELECT ID,Name FROM tblteacher WHERE (Email=:username || MobileNumber=:username) and password=:password";
        $query = $dbh->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        if ($query->rowCount() > 0) 
    {
            foreach ($results as $result) {
                $_SESSION['trmsuid'] = $result->ID;
                $_SESSION['trmstname'] = $result->Name;
            }
            echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
        }
        else {
            $_SESSION["login_attempts"] += 1;
            echo "<script>alert('Invalid Details');</script>";
        }

 
}}

?>
    
<!doctype html>
<html class="no-js" lang="en">
<head>    
    <title>TRMS Admin Login</title>   

    <link rel="apple-touch-icon" href="apple-icon.png"> 

    <link rel="stylesheet" href="../vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../vendors/selectFX/css/cs-skin-elastic.css">

    <link rel="stylesheet" href="css\styles.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body class="bg-dark" style=" background-image: linear-gradient(rgba(255,255,255,.1), rgba(255,255,255,.1)),url('images/login.jpg');">


    <div class="sufee-login d-flex align-content-center flex-wrap" >
        <div class="container" style="display: flex;align-items: center;justify-content: center;margin-top: 80px;">
            <div class="login-content" style="background: rgba(105, 105, 105, 0.6);padding-left: 100px;padding-right: 100px;" >
                <div class="login-logo">
                    <br>
                    <h2 style="color:black">Teacher Records Management System </h2>
                    <hr  color="red"/>
                </div>
                <div class="login-form">
                    <form action="" method="post" name="login">
                        
                        <div class="form-group">
                            <h6><label>Email Id / Mobile Number</label></h6>
                            <input type="text" class="form-control" placeholder="Email id / Mobile Number" required="true" name="username" id="username">
                        </div>
                            <div class="form-group">
                                <h6><label>Password:</label><h6>
                                <input type="password" class="form-control" placeholder="Password" name="password" id="myInput" required="true"><br>
                                <div class="message" style="text-align: justify;text-align-last: right;"></div>
                                <input type="checkbox" onclick="myFunction()"> Show Password
                                
                        </div>
                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30" name="login" onclick="lsRememberMe()">Sign in</button><br>
                                
                              <div class="checkbox">
                                    <label class="pull-left"><br>
                                <a href="../index.php"><h7 style="color: #00008B;font-weight:bold">Back Home!!</h7></a>
                                    <label class="pull-right">
                                <a href="forgot-password.php" style="padding-left: 250px"><h7 style="color: #00008B;font-weight:bold">Forgot Password? </h7></a></label>&emsp;&emsp;&emsp;&emsp;&emsp;<
                              </div>
                                            
                                <div><input type="checkbox" value="lsRememberMe" id="rememberMe"><h7 style="font-weight:bold"><label for="rememberMe">&nbsp;Remember me</label></h7><br></div>
                                <hr style="border-top: 1px solid red;"/><br>
                                <p><h7 style="color: #00008B;font-weight:bold;">Not Registered Yet | </h7><a href="signup.php" style="color: #002A47;font-weight:bold;">Signup Here</a></p><br>
                                
                            
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <script src="../vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/main.js"></script>
    <script>
    function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
const password = document.querySelector('#myInput');
 const message = document.querySelector('.message');

 password.addEventListener('keyup', function (e) {
     if (e.getModifierState('CapsLock')) {
         message.textContent = 'Caps lock is on';
     } else {
         message.textContent = '';
     }
 });
 const rmCheck = document.getElementById("rememberMe"),
    emailInput = document.getElementById("username");

if (localStorage.checkbox && localStorage.checkbox !== "") {
  rmCheck.setAttribute("checked", "checked");
  emailInput.value = localStorage.username;
} else {
  rmCheck.removeAttribute("checked");
  emailInput.value = "";
}

function lsRememberMe() {
  if (rmCheck.checked && emailInput.value !== "") {
    localStorage.username = emailInput.value;
    localStorage.checkbox = rmCheck.value;
  } else {
    localStorage.username = "";
    localStorage.checkbox = "";
  }
}
</script>


</body>

</html>
