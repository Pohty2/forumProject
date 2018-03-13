<?php
use classes\business\UserManager;
use classes\business\Validation;

require_once 'includes/autoload.php';
include 'includes/header.php';
//require_once('class.phpmailer.php');
//require_once "class.smtp.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require "includes/SMTP.php";
require "includes/PHPMailer.php";
require "includes/Exception.php";
require_once 'includes/password.php';
$formerror="";
$email="";
$password="";
$error_auth="";
$error_name="";
$error_passwd="";
$error_email="";
$validate=new Validation();

	if(isset($_POST["submitted"])){
		$email=$_POST["email"];	
		$validate->check_email($email, $error_email);
		$UM=new UserManager();
		$existuser=$UM->getUserByEmail($email);
		
		if(isset($existuser)){
				//generate new password
				$newpassword=$UM->randomPassword(8,1,"lower_case,upper_case,numbers");
				//update database with new password
				$forgothash=password_hash($newpassword[0], PASSWORD_BCRYPT, array("cost" => 10));
				$UM->updatePassword($email,$forgothash);  
				//coding for sending email
				// do work here
				
				//error_reporting(E_ALL);
				//error_reporting(E_STRICT);
				//date_default_timezone_set('Singapore');
				$mail             = new PHPMailer(true);
				$mail->IsSMTP(true); // telling the class to use SMTP
				$mail->SMTPOptions = array(
					'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
								  )
										  );
				//$mail->Host       = "mail.yourdomain.com"; // SMTP server
				//$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
														   // 1 = errors and messages
														   // 2 = messages only
				$mail->SMTPAuth   = true;                  // enable SMTP authentication
				$mail->IsHTML(true);
				$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
				$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server smtp.gmail.com
				$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
				$mail->Username   = "example@email.com";  // GMAIL username
				$mail->Password   = "password";            // GMAIL password

				$mail->SetFrom('example@gmail.com', '[Admin] ABC Jobs Pte Ltd');
				$mail->Subject    = "Reset Password";			
				$mail->Body = "Your Temporary Password is ".$newpassword[0];
		
				$mail->AddAddress($email);

				if(!$mail->Send()) {
				  echo "Mailer Error: " . $mail->ErrorInfo;
				} else {
				  $formerror="New password have been sent to ".$email;
				}
										
				//$formerror="New password have been sent to ".$email;
				//header("Location:home.php");
		}else{
				$formerror="Invalid email user";
		}
	}

?>
<!DOCTYPE html>
<html lang="en">
        <head>
              <title>Forget password page</title>
              <meta charset="utf-8">
              <meta name="viewport" content="width=device-width, initial-scale=1">
              <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
              <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <link rel="stylesheet" href=".\css\pure-release-1.0.0\pure-min.css">
            <style>
            .error{color:red;}
            </style>
        </head>
<body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 hidden-sm hidden-xs" style="background-image: url(http://localhost/phpcrudsample/public/images/forget.jpg);padding-bottom:530px; "></div>
                <div class="col-md-6 col-md-12">
                <h1 style="margin-top: 60px;text-align:center;"><b>Forget your password?</b></h1>
                <div class="container" >
                         <div class="row">
                             <div class="col-md-6 col-lg-6" style="background-color: #D7D7D7; border-radius: 20px; margin-left:40px; display:block;">
                                <form name="myForm" method="post" class="pure-form pure-form-stacked">
                                <div class="form-group" style="margin-top:20px;">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" placeholder="Enter your email here" name="email" value="<?=$email?>" pattern=".{1,}"   required title="Cannot be empty field">
                                    <span class="error"><?php echo $error_email?></span>
                                  </div>
                                 
                                 <input type="submit" name="submitted" value="Submit" class="pure-button pure-button-primary" style="display:block; margin:0 auto; margin-top:30px; margin-bottom:30px;">
                                 <p style="text-align: center;"><span class="error"><?php echo $formerror?></span></p>
                                 <p style="text-align:center; margin-top:10px; margin-bottom:30px;">Clicking the submit buttton will send an email to that registered email account. Please check the email for more your new randomized password.</p>                         
                                </form>
                            </div>
                        </div>
                    </div>                              
                </div>
                <div class="col-md-3 hidden-sm hidden-xs" style="background-image: url(http://localhost/phpcrudsample/public/images/forget.jpg); padding-bottom:530px; "></div>
            </div>
		</div>
