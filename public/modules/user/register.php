<?php
require_once '../../includes/autoload.php';
include '../../includes/header.php';
require_once '../../includes/password.php';
use classes\business\UserManager;
use classes\business\Validation;
use classes\util\DBUtil;
use classes\entity\User;

$formerror="";

$firstName="";
$lastName="";
$email="";
$password="";
$cpassword="";
$hash="";
$error_passwd="";
$error_name="";
$error_email="";

$validate=new Validation();
/**
 * checks if user has click the submit button.
 */
if(isset($_REQUEST["submitted"])){
    $firstName=$_REQUEST["firstName"];
    $lastName=$_REQUEST["lastName"];
    $email=$_REQUEST["email"];
    $password=$_REQUEST["password"];
    $cpassword=$_REQUEST["cpassword"];
    $hash = password_hash($password, PASSWORD_BCRYPT);
    
    $password = trim($password);
    $cpassword = trim($cpassword);
    
    /**
     * performs validation checks on the user inputs.
     */
    if($password==$cpassword){
        if($firstName!='' && $lastName!='' && $email!='' && $password!='' && $validate->check_password($password, $error_passwd) && $validate->check_name($firstName, $error_name) && $validate->check_name($lastName, $error_name) && $validate->check_password($password, $error_passwd)){      
            $UM=new UserManager();
            $user=new User();
            $user->firstName=$firstName;
            $user->lastName=$lastName;
            $user->email=$email;
            $user->password=$hash;
            $user->role="user";
            $existuser=$UM->getUserByEmail($email);
            /**
             * checks for if the email input by user is already taken.
             */
            if(!isset($existuser)){
                // Save the Data to Database
                $UM->saveUser($user);
                #header("Location:registerthankyou.php");
    			echo '<meta http-equiv="Refresh" content="1; url=./registerthankyou.php">';
            }
            else{
                $formerror="User Already Exist";
            }
        }else{
            $formerror="Please fill in all the fields and made sure there are no errors in the fields.";
        }
    }else{
        $formerror="The password and Confirm Password fields do not match. Please double check them.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
        <head>
          <title>Registration page</title>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="..\..\css\pure-release-1.0.0\pure-min.css">
        <link rel="stylesheet" type="text/css" href="..\..\css\password_style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
            </head>
    <body>
    <!--this is the main content area-->
    <div class="container-fluid" style="background-image: url(http://localhost/phpcrudsample/public/images/discussion.gif); margin-botton:100px;">
        <div class="row">
            <div class="col-sm-offset-3 col-sm-6" style="background-color:rgba(215, 215, 215, 0.8); margin-top:40px; margin-bottom: 200px;">
            <form>
            <h1 style="text-align: center;">Registration Form</h1>
            <div><?=$formerror?></div>
                <div class="row" style=" margin-top:20px;">
                    <div class="col-sm-6">
                        <h5><b>First name</b></h5>
                        <input type="text" name="firstName" placeholder="Enter the first name here" value="<?=$firstName?>" style="width:100%"><?php echo $error_name?>
                    </div>
                    <div class="col-sm-6">
                        <h5><b>Last name</b></h5>
                        <input type="text" name="lastName" placeholder="Enter the last name here" value="<?=$lastName?>" style="width:100%"><?php echo $error_name?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <h5><b>Email</b></h5>
                        <input type="text" name="email" placeholder="Enter your email here" value="<?=$email?>" style="width:100%"><?php echo $error_email?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <h5><b>Password (6 characters or more)</b></h5>
                        <input type="password" name="password" id="pass" placeholder="Enter your password here" value="<?=$password?>" style="width:100%"><?php echo $error_passwd?>
                        <div id="meter_wrapper" style="display: none;"><div id="meter"></div></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <h5><b>Confirm Password</b></h5>
                        <input type="password" name="cpassword" placeholder="Enter your password here again" value="<?=$cpassword?>" style="width:100%">
                    </div>
                </div>                  
                <div class="row">
                    <div class="col-sm-12" style="margin-top:10px; margin-bottom:10px;">
                        <input type="submit" name="submitted" value="Submit" class="btn btn-lg btn-default" style="margin:0 auto; display:block; margin-bottom:10px;"><input type="reset" name="reset" value="Reset" class="btn btn-lg btn-default" style="margin:0 auto; display:block;">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12" style="margin-top:10px; margin-bottom:10px;">
                        <p style="text-align:center;"><b>Already have an account? <a href="../../login.php" class="text-danger">Sign in here</a></b></p>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>