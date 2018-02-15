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
use classes\entity\Threadattach;
$formerror="";

$userid= $_SESSION['id'];
$message="";

$validate=new Validation();
/**
 * checks if user has click the submit button.
 */
if(isset($_REQUEST["submitted"])){
    $message=$_REQUEST["message"];
    
    /**
     * performs validation checks on the user inputs.
     */
    if( $message!=''  &&  $validate->check_name($message, $error_name)){
            $TM=new ThreadManager();
            $thread=new Threadattach();
            $thread->userid=$userid;
            $thread->threadid=$_GET['Threadmsgid'];
            $thread->message=$message;
            $TM->saveReply($thread);
            
            
        }else{
            $formerror="Please fill in the field and made sure there are no errors in the fields.";
        }
}
?>

<!DOCTYPE html>
<html lang="en">
        <head>
          <title>Comment on a Thread</title>
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
                        <h1 style="text-align: center"><b>Comment on a Thread</b></h1>
                    </div>
                    <div><?=$formerror?></div>
                    <form name="searchform" method="post" style="margin-left: 20px;" class="pure-form pure-form-stacked">                   
                    <div class="row">
                        <div class="col-sm-12">
                            <h4><b>Thread comment</b></h4>
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