<?php
session_start();
session_regenerate_id(TRUE);
require_once '../../includes/autoload.php';
require_once '../../includes/pmsystem.php';

use classes\business\UserManager;
use classes\entity\User;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';

$to = $_GET["id"];
$result="";

/**
 * if user clicks the search button.
 */
if(isset($_POST["send"])){
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        
        $NM=new Private_messaging_system();
        $users=$NM->send_message($to, $message, $subject, $respond = 0);
        $result="Your message has been sent";
}

?>
<!DOCTYPE html>
<html lang="en">
        <head>
          <title>Send messages</title>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		  <link rel="stylesheet" href="..\..\css\pure-release-1.0.0\pure-min.css">
		  </head>
	<br><br>
	<!--main content area-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h1 style="text-align: center;"><b>Compose message</b></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">
                <a href="/phpcrudsample/public/modules/user/pmlist.php"><button type="button" class="btn btn-lg btn-primary">Inbox</button></a>
            </div>
            <div class="col-sm-9" style="background-color: #F2F2F2; border-radius: 5px;">
                <form name="messageform" method="post" style="margin-left: 20px;" class="pure-form pure-form-stacked">
                <table style="margin-top: 20px;">
            	<tr>
            		<td>Subject:</td>
            		<td><input type="text" name="subject" placeholder="Write your subject here..." size="50"></td>
            	</tr>
            	<tr>
            		<td>Message:</td>
            		<td><textarea name="message" rows="3" style="resize:none;" cols="48" placeholder="Write your message here..."></textarea></td>
            	</tr>
            	<tr>
                	<td><input type="submit" name="send" value="send" class="btn btn-md btn-primary" style="margin-top:20px; margin-bottom:20px;"></td>
                	<td><input type="reset" value="Clear fields" class="btn btn-md btn-primary" style="margin-top:20px; margin-bottom:20px;"></td>
            	</tr>
            	<tr>
            		<td><?=$result?></td>
            	</tr>
            	</table>
            	</form>
        	</div>
		</div>
  </div>

<?php
include '../../includes/footer.php';
?>