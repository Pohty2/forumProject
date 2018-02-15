<?php
session_start();
session_regenerate_id(TRUE);
require_once '../../includes/autoload.php';
include '../../includes/header.php';
require_once '../../includes/password.php';

use classes\business\ThreadManager;
use classes\business\Validation;
use classes\util\DBUtil;
use classes\entity\User;
use classes\entity\Thread;
$formerror="";

$userid= $_SESSION['id'];
$subject="";
$message="";
$type="";

$validate=new Validation();
/**
 * checks if user has click the submit button.
 */
if(isset($_REQUEST["submitted"])){
    $subject=$_REQUEST["subject"];
    $message=$_REQUEST["message"];
    $type=$_REQUEST["type"];
    
    /**
     * performs validation checks on the user inputs.
     */
    if($subject!='' && $message!=''  && $validate->check_name($subject, $error_name) && $validate->check_name($message, $error_name)){
            $TM=new ThreadManager();
            $thread=new Thread();
            $thread->userid=$userid;
            $thread->subject=$subject;
            $thread->message=$message;
            $thread->type=$type;
            $TM->saveThread($thread);
            
            
        }else{
            $formerror="Please fill in all the fields and made sure there are no errors in the fields.";
        }
}
?>

<!DOCTYPE html>
<html lang="en">
        <head>
          <title>Post in message board</title>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        </head>
    <body>
    <!--main content area-->
        <div class="container-fluid" style="background-image: url(http://localhost/phpcrudsample/public/images/meeting.png); margin-botton:100px;"> 
            <div class="row">
                <div class="col-sm-offset-1 col-sm-10" style="background-color: rgba(255, 255, 255, 0.8); margin-top: 40px; margin-bottom: 80px; border-radius: 5px;">
                    <div class="row">
                        <h1 style="text-align: center"><b>Post in message board</b></h1>
                    </div>
                    <div><?=$formerror?></div>
                    <form name="searchform" method="post" style="margin-left: 20px;" class="pure-form pure-form-stacked">
                    <div class="row">
                        <div class="col-sm-5">
                            <h4><b>Subject</b></h4>
                            <input type="text" name="subject" placeholder="Enter the subject of the thread here" style="width:100%">                
                        </div>
                        <div class="col-sm-2" style="margin-top:40px;">
                     <select name="type" style="height:25px;">
                          <option value="job opening">job opening</option>
                          <option value="discussion">discussion</option>
                        </select> 
                </div> 
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h4><b>Thread message</b></h4>
                            <textarea rows="7" cols="50" name="message" style="width:100%; resize: none;" placeholder="Enter the thread message here"></textarea>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-sm-12" style="margin-top: 20px; margin-bottom:20px;">
                        <input type="submit" name="submitted" value="submit" class="btn btn-lg btn-default">
                        </div>
                    </div>
                    </form>
                </div>                
            </div>            
        </div>    
    </body>
</html>