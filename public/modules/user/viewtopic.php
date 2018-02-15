<?php
session_start();
session_regenerate_id(TRUE);
require_once '../../includes/autoload.php';
require_once '../../includes/password.php';

use classes\business\ThreadManager;
use classes\entity\Thread;
use classes\business\UserManager;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';

$subject="";
$threadmessage="";
$type="";
$number="";
$country="";
$city="";
$writeup="";

$_SESSION['Threadid']=$_GET['Threadid'];

/**
 * auto populates the fields of the form with the selected user's details, either with values fetched from the database, or the values inputted by the admin.
 */
  $UM=new ThreadManager();
  $existuser=$UM->getThread($_GET["Threadid"]);
  $threadid=$existuser->threadid;
  $subject=$existuser->subject;
  $message=$existuser->message;
  $type=$existuser->type;
  
?>
<!DOCTYPE html>
<html lang="en">
        <head>
          <title>Read a thread</title>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        </head>
    <body>
    <!--main content area-->
        <div class="container-fluid" style="background-image: url(http://localhost/phpcrudsample/public/images/discussion.gif); margin-botton:100px;"> 
            <div class="row">
                <div class="col-sm-offset-1 col-sm-10" style="background-color: rgba(255, 255, 255, 0.8)">
                    <h3 style="margin:30px;"><b><?=$subject?></b></h3>
                    <div style="height:140px; width:90%; background-color: white; margin-left:30px;"> 
                    	<p style="padding-top: 10px; padding-left:20px; font-size:20px; text-align: left">Thread Type: <?=$type?></p>
                        <h4 style="display:block; padding-top: 30px; padding-bottom: 20px;text-align: center"><?=$message?></h4>
                    </div>
                </div>
                <?php 
                $TM=new ThreadManager();
                $UM=new UserManager();
                $threadcomments=$TM->getAllcomments($threadid);
                
                foreach ($threadcomments as $threadcomment){
                    if($threadcomment!=null){
                    $message=$threadcomment->message;
                    $threadmsdid=$threadcomment->threadmsgid;
                    $user=$UM->getFirstNameById($threadcomment->userid)
                    
                ?>
                <div class="col-sm-offset-1 col-sm-10" style="background-color: rgba(255, 255, 255, 0.8)">
                    <div style="width:90%; background-color: white; margin-left:30px;">  
                        <h5 style="padding:10px;"><b><?=$user?></b></h5>
                        <p style="padding:10px;"><?=$message?></p>
                        <?php 
                        $TTM=new ThreadManager();
                        $threadreplies=$TTM->getAllreplies($threadmsdid);
                        foreach ($threadreplies as $threadreply){
                            if($threadreply!=null){
                                $message=$threadreply->message;                               
                                $user=$UM->getFirstNameById($threadreply->userid)                        
                        ?>
                        <div style="width:90%; background-color: grey; margin-left:30px;">
                            <h5 style="padding:10px;"><b><?=$user?></b></h5>
                            <p style="padding:10px;"><?=$message?></p>
                            <p style="padding:10px;"><a href='replypost.php?Threadmsgid=<?php echo $threadreply->threadmsgid ?>'>Reply</a></p>
                        </div>
                        <?php 
                            }
                        }
                        ?> 
                        
                    </div> 
                               
                </div> 
                 <?php 
                    }
                }
                ?>        
                <div class="container" style="padding-bottom:30px; background-color: rgba(255, 255, 255, 0.8);">
                <div class="col-sm-2">
                        <a href='commentpost.php?Threadid=<?php echo $threadid ?>'><button type="button" class="btn btn-lg btn-primary" style="margin:20px; margin-left:10px;">Comment</button></a>
                    </div> 
                    </div>             
            </div>
        </div>
    </body>
</html>


<?php
include '../../includes/footer.php';
?>