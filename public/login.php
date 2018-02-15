<?php
session_start();
use classes\business\UserManager;
use classes\business\Validation;
session_regenerate_id(TRUE);
require_once 'includes/autoload.php';
include 'includes/header.php';
require_once 'includes/password.php';
$formerror="";

$email="";
$password="";
$error_auth="";
$error_passwd="";
$error_email="";
$hash="";
$dbpass="";

$validate=new Validation();
/**
 * checks for if the user has clicked the submit button, and if so, validates the form fields.
 */
if(isset($_POST["submitted"])){
    $email=$_POST["email"];
    $password=$_POST["password"];
    	if($validate->check_password($password, $error_passwd))
    	{
    	    /**
    	     * if there are no errors with validation, the following functions will try to verify the user with the database and allow login if success.
    	     */
    		$UM=new UserManager();
    
    		$existuser=$UM->getUserByEmail($email);
    		if(isset($existuser)){
    		    $dbpass = $existuser->password;
    		    if ($verified=(password_verify($password, $dbpass))){ 		        		   
        			$_SESSION['role']=$existuser->role;
        			$_SESSION['email']=$email;
        			$_SESSION['id']=$existuser->id;
        			$_SESSION['password']=$password;
        			;
        			echo '<meta http-equiv="Refresh" content="1; url=home.php">';
    		    }else{
    		        $formerror="Invalid User Name or Password";
    		    }
    		}else{
    			$formerror="Invalid User Name or Password";
    		}
    }else {
        $formerror="Invalid User Name or Password";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
        <head>
          <title>Login page</title>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
          <link rel="stylesheet" href=".\css\pure-release-1.0.0\pure-min.css">
        </head>
    <body>
	<div class="container" style="background-image: url(http://localhost/phpcrudsample/public/images/stand.jpg); padding-bottom: 125px;">
         <div class="row">
             <div class="col-sm-6 col-sm-offset-3">
                 <h1 style="text-align: center; background-color: rgba(240, 240, 240, 0.7); border-radius:5px;">Log in to access the full features</h1>
             </div>
         </div>
         <form name="myForm" method="post">
         <div class="container" >
             <div class="row">
                 <div class="col-sm-offset-3 col-sm-6" style="background-color: rgba(215, 215, 215, 0.9); border-radius: 20px;">
                     <div class="form-group" style="margin-top:20px;">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" value="<?=$email?>" pattern=".{1,}" placeholder="Enter your email here"  required title="Cannot be empty field" size="30">                 
                      </div>
                      <div class="form-group">
                        <label for="pwd">Password</label>
                        <input type="password" class="form-control" placeholder="Enter your password here" name="password" value="<?=$password?>">
                        <span style="color:red";><?php echo $error_passwd?></span>
                      </div>
                      <input type="submit" name="submitted" value="Submit" class="pure-button pure-button-primary" style="display:block; margin:0 auto; margin-top:30px; margin-bottom:10px;">
                      <input type="reset" name="reset" value="Reset" class="pure-button pure-button-primary" style="display:block; margin:0 auto; margin-bottom:10px;">
                     <p style="text-align:center;"><b>Don't have an account? <a href="modules/user/register.php" class="text-danger">Sign up here</a></b></p>
                     <p style="text-align:center; margin:20px;"><b>Forgot your password? <a href="./forgetpassword.php" class="text-danger">Click here</a></b></p>
                     <p style="text-align:center;"><span style="color:red";><b><?php echo $formerror?></b></span></p>
                 </div>
             </div>
         </div>
         </form>
      </div>
	</body>
</html>