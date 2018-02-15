<?php
session_start();
session_regenerate_id(TRUE);
require_once '../../includes/autoload.php';
require_once '../../includes/password.php';

use classes\business\UserManager;
use classes\entity\User;
use classes\business\Validation;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';
?>

<?php

$formerror="";
$firstName="";
$lastName="";
$email="";
$password="";
$number="";
$country="";
$city="";
$writeup="";
$error_email="";
$error_passwd="";

$validate=new Validation();

/**
 * if user clicks the submit button.
 */
if(!isset($_POST["submitted"])){
  $UM=new UserManager();
  $existuser=$UM->getUserByEmail($_SESSION["email"]);
  $firstName=$existuser->firstName;
  $lastName=$existuser->lastName;
  $email=$existuser->email;
  $password=$_SESSION["password"];
  $cpassword=$_SESSION["password"];
  $number=$existuser->number;
  $country=$existuser->country;
  $city=$existuser->city;
  $writeup=$existuser->writeup;
}else{
  $firstName=$_POST["firstName"];
  $lastName=$_POST["lastName"];
  $email=$_POST["email"];
  $password=$_POST["password"];
  $cpassword=$_POST["cpassword"];
  $number=$_POST["number"];
  $country=$_POST["country"];
  $city=$_POST["city"];
  $writeup=$_POST["writeup"];
  
  /**
   * validation checks happen here on the user inputs.
   */
  if($firstName!='' && $lastName!='' && $email!='' && $password!='' && $number!=''){
      if(($validate->check_password($password, $error_passwd)) && ($validate->check_email($email, $error_email))){
          if ($password == $cpassword){
              $update=true;
              $UM=new UserManager();
              if($email!=$_SESSION["email"]){
                  $existuser=$UM->getUserByEmail($email);
                  if(is_null($existuser)==false){
                      $formerror="User Email already in use, unable to update email";
                      $update=false;
                  }
              }
              if($update){
                  $existuser=$UM->getUserByEmail($_SESSION["email"]);
                  $existuser->firstName=$firstName;
                  $existuser->lastName=$lastName;
                  $existuser->email=$email;
                  $hash = password_hash($password, PASSWORD_BCRYPT);
                  $existuser->password=$hash;
                  $existuser->number=$number;
                  $existuser->country=$country;
                  $existuser->city=$city;
                  $existuser->writeup=$writeup;
                  $UM->saveUser($existuser);
                  $_SESSION["email"]=$email;
                  $_SESSION["password"]=$password;
                  echo "<br> Your details have been updated.";
              }
          }else{
              $formerror="The password and Confirm Password fields do not match. Please double check them.";
          }
      }else{
          $formerror="Please double check your fields.";
      }
  }
  else{
      $formerror="Please provide required values.";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
        <head>
          <title>Details update</title>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>       
            <link rel="stylesheet" href="..\..\css\pure-release-1.0.0\pure-min.css">
            <link rel="stylesheet" type="text/css" href="..\..\css\password_style.css">
        </head>
	<body>
            <form name="myForm" method="post" class="pure-form pure-form-stacked">
            <script type="text/javascript">
            $(document).ready(function(){
                $("#pass").keyup(function(){
                    check_pass();
                });
            });
                
                function check_pass()
                {
                	document.getElementById("meter_wrapper").style.display = 'block';
                    var val=document.getElementById("pass").value;
                    var meter=document.getElementById("meter");
                    var no=0;
                    if(val!="")
                    {
                    	
                        // If the password length is less than or equal to 6
                        if(val.length<=6)no=1;
                        
                        // If the password length is greater than 6 and contain any lowercase alphabet or any number or any special character
                        if(val.length>6 && (val.match(/[a-z]/) || val.match(/\d+/) || val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)))no=2;
                            
                            // If the password length is greater than 6 and contain alphabet,number,special character respectively
                            if(val.length>6 && ((val.match(/[a-z]/) && val.match(/\d+/)) || (val.match(/\d+/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) || (val.match(/[a-z]/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))))no=3;
                                
                                // If the password length is greater than 6 and must contain alphabets,numbers and special characters
                                if(val.length>6 && val.match(/[a-z]/) && val.match(/\d+/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))no=4;
                                    
                                    if(no==1)
                                    {
                                        $("#meter").animate({width:'50px'},300);
                                        meter.style.backgroundColor="red";
                                        document.getElementById("pass_type").innerHTML="Very Weak";
                                    }
                                    
                                    if(no==2)
                                    {
                                        $("#meter").animate({width:'100px'},300);
                                        meter.style.backgroundColor="#F5BCA9";
                                        document.getElementById("pass_type").innerHTML="Weak";
                                    }
                                    
                                    if(no==3)
                                    {
                                        $("#meter").animate({width:'150px'},300);
                                        meter.style.backgroundColor="#FF8000";
                                        document.getElementById("pass_type").innerHTML="Good";
                                    }
                                    
                                    if(no==4)
                                    {
                                        $("#meter").animate({width:'200px'},300);
                                        meter.style.backgroundColor="#00FF40";
                                        document.getElementById("pass_type").innerHTML="Strong";
                                    }
                    }
                    
                    else
                    {
                        meter.style.backgroundColor="white";
                        document.getElementById("pass_type").innerHTML="";
                    }
                }
            </script>
 <!--extra header-->
 <div class="container-fluid" style="background-color:#137EAC">
        <div class="row">
            <div class="col-sm-12" style="text-align: center;">
                <h1 style="color:#595959"><b>Update your personal details</b></h1>
                <h4 style="color:#BCBCBC"><b>Have something to add? Include additional information like your personal achievements or a short write up</b></h4>

                <h4 style="color:#BCBCBC"><b>introducing yourself so others can identify with you and know exactly what they can get from you</b></h4><br>                      
            </div>
        </div>
 </div>
<div class="container" style="background-color:#50BCEB; padding-top:20px; padding-bottom:50px;">
<div><?=$formerror?></div>
<div><?=$error_passwd?></div>
<div><?=$error_email?></div>

<table width="800" style="margin-left:20px;">
  <tr>
    <td>First Name</td>
    <td><input type="text" name="firstName" value="<?=$firstName?>" size="50"></td>
  </tr>
  <tr>
    <td>Last Name</td>
    <td><input type="text" name="lastName" value="<?=$lastName?>" size="50"></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><input type="text" name="email" value="<?=$email?>" size="50"></td>
  </tr>
  <tr>    
    <td>Password</td>
    <td><input type="password" name="password" id="pass" value="<?=$password?>" size="20"></td>
    <td><div id="meter_wrapper" style="display: none;"><div id="meter"></div></div></td>    
  </tr>
  <tr>
  	<td></td>
  	<td><span id="pass_type"></span></td>
  </tr>  
  <tr>
    <td>Confirm Password</td>
    <td><input type="password" name="cpassword" value="<?=$cpassword?>" size="20"></td>
  </tr>
  <tr>
    <td>Number</td>
    <td><input type="text" name="number" value="<?=$number?>" size="50"></td>
  </tr>
  <tr>
    <td>Country</td>
    <td><input type="text" name="country" value="<?=$country?>" size="50"></td>
  </tr>
  <tr>
    <td>City</td>
    <td><input type="text" name="city" value="<?=$city?>" size="50"></td>
  </tr>
  <tr>
    <td>Writeup</td>
    <td><textarea name="writeup" rows="3" style="resize:none;" cols="48"><?=$writeup?></textarea></td>
  </tr>
  <tr>
    <td><input type="submit" name="submitted" value="Submit" class="btn btn-md btn-default"><input type="reset" name="reset" value="Reset" class="btn btn-md btn-default" style="margin-left:20px;"></td>    
  </tr>
  </table>
</div>
</form>


<?php
include '../../includes/footer.php';
?>
</body>