<?php
session_start();
session_regenerate_id(TRUE);
require_once '../../includes/autoload.php';
require_once '../../includes/password.php';
require_once '../../includes/pmsystem.php';

use classes\business\UserManager;
use classes\entity\User;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';

$formerror="";
$firstName="";
$lastName="";
$email="";
$password="";
$number="";
$country="";
$city="";
$writeup="";

$NM=new Private_messaging_system();
$allmsg=$NM->get_all_messages();

$UM=new UserManager();

if(isset($allmsg)){
    ?>
	<link rel="stylesheet" href="..\..\css\pure-release-1.0.0\pure-min.css">
	<div class="container">
    <br/><br/><p style="margin-left: 20px; font-size:25px;"><b>Inbox</b></p>
    <div class="col-sm-10" style="background-color: #9BD9F4; border-radius: 5px;">
            <table class="pure-table pure-table-bordered" width="900" style="margin-top: 20px;">
                    <tr>
        			<thead>
                       <th><b>To User</b></th>
                       <th><b>From User</b></th>
                       <th><b>Subject</b></th>
                       <th><b>Message</b></th>
                       <th><b>Action</b></th>
        			   </thead>
                    </tr>    
            <?php 
            foreach ($allmsg as $msg) {
                if($msg!=null){
                    $userto=$UM->getFirstNameById($msg->user_to);
                    $userfrom=$UM->getFirstNameById($msg->user_from);           
                    ?>
                    <tr>
                       <td style="background-color: white;"><?=$userto?></td>
                       <td style="background-color: white;"><?=$userfrom?></td>
                       <td style="background-color: white;"><?=$msg->subject?></td>
                       <td style="background-color: white;"><?=$msg->message?></td>
                       <td style="background-color: white;"><a href='sendmsg.php?id=<?=$msg->user_from?>'>Reply</a></td>
                    </tr>
                    <?php 
                }
            }
            ?>
            </table><br/><br/>
            <?php 
        }
        ?>
        </div>
    </div>

<?php
include '../../includes/footer.php';
?>