<?php
session_start();
if (isset($_POST['submit'])) {
	eligible();
}
function eligible()	{
        $job = $_POST['Application for'];
        $experience = $_POST['teachingexp'];
        $graduation = $_POST['graduation'];
        $country = $_POST['Citizenship'];        
	       intval($experience);
        intval($graduation);
	if(strcmp($job,"Physics")){
         if ($experience >=2 && $graduation >=60 && strcmp($country,"India"))
         echo ("<script LANGUAGE='JavaScript'>
              window.alert('You are eligible to apply');
              window.location.href='teacher/signup.php';
              </script>");
         else
         echo ("<script LANGUAGE='JavaScript'>
              window.alert('You are not eligible to apply');
              window.location.href='index.php';
              </script>");
        }	
  else
      {
         if ($experience >=4 && $graduation >=80 && strcmp($country,"India"))
         echo ("<script LANGUAGE='JavaScript'>
              window.alert('You are eligible to apply');
              window.location.href='teacher/signup.php';
              </script>");
         else
         echo ("<script LANGUAGE='JavaScript'>
              window.alert('You are not eligible to apply');
              window.location.href='index.php';
              </script>");
	    }
}
?>
<!doctype html>
<html class="no-js" lang="en">
<head>    
    <title>Eligibility</title> 
    <link rel="stylesheet" href="../vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>

<style>
        fieldset{
           
            border-radius: 2px;
            margin-bottom: 12px;
            overflow: hidden;
            padding: 0 .625em;
        }

        label{
            cursor: pointer;
            display: inline-block;
            padding: 3px 6px;
            text-align: left;
            width: 270px;
            vertical-align: top;
            font-size: large;
            font-weight: bold;
        }
        .error {color: #FF0000;}
        input{
          border: 2px;
          border-style: solid;
          border-color: black;
          

        }

    </style>

<body class="bg-dark" style=" background-image: linear-gradient(rgba(255,255,255,.0), rgba(255,255,255,.0)),url('images/eligibilty.jpg');">
<div class="sufee-login d-flex align-content-center flex-wrap" >
        <div class="container"style="display: flex;align-items: center;justify-content: center;">
            <div class="login-content" style="background: rgba(105, 105, 105, 0.4);padding-left: 100px;padding-right: 100px;padding-bottom: 40px;">
<form name="" method="post" action="" enctype="multipart/form-data">
    <fieldset>
      <legend><h1>Job</h1></legend>
      <p><label>Apply for<span class="error"> *</span></label>
        <select name="Application for" required>
          <option>Physics</option>
          <option>Computer science</option>
        </select> </p>
      <p><label>First name <span class="error"> *</span></label>
        <input type="text" name="First name" required align="left"></p>
      <p><label> Last name <span class="error"> *</span></label>
        <input type="text" name="Last name" required align="left"><p>

      <p><label>Citizenship <span class="error"> *</span></label>
       <input type="text" name="Citizenship" required="true" align="left"></p>
      <p><label>Date of birth <span class="error"> *</span></label>
      <input type="date" name="Date of birth" required align="left"></p>

      <p><label>Teaching Experience (in Years)<span class="error"> *</span></label>
        <input type="text" name="teachingexp" pattern="[0-9]+" required="true" align="left"></p>
      <p><label>Graduation percentage <span class="error"> *</span></label>
       <input type="text" name="graduation" pattern="[0-9]+" required="true" align="left"> %</p>

      <p><label>Phone <span class="error"> *</span></label><input type="tel" name="Phone" required align="left"></p>
      <p><label>Email address <span class="error"> *</span></label> <input type="email" name="Email" required align="left"></p>
  
      <p><label>Application letter</label><input type="file" name="Application letter" accept=".doc,.docx,.pdf" align="left"></p>
      <p><label>Resume upload</label><input type="file" name="resume upload" accept=".doc,.docx,.pdf" align="left"></p><br>
        

      <div class="btns" ><input type="submit" name="submit", value="Check Eligibility"></div><br><br>
      </fieldset> 
   
   
    
  </form>
  
  <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <script src="../vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/main.js"></script>
  
      </div>
      <div>
      </div>
</body>
</html>