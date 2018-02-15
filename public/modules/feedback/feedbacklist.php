<?php
session_start();
session_regenerate_id(TRUE);
require_once '../../includes/autoload.php';

use classes\business\FeedbackManager;
use classes\entity\Feedback;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';

$UM=new FeedbackManager();
$feedback=$UM->getAllFeedback();

if(isset($feedback)){
    ?>
	<link rel="stylesheet" href="..\..\css\pure-release-1.0.0\pure-min.css">
    <br/><br/>Below is the list of Feedback given by the Developers registered in community portal <br/><br/>
    <table class="pure-table pure-table-bordered" width="800">
            <tr>
			<thead>
               <th><b>Id</b></th>
               <th><b>First Name</b></th>
               <th><b>Last Name</b></th>
               <th><b>Email</b></th>
			   <th><b>Comments</b></th>
			   </thead>
            </tr>    
    <?php 
    foreach ($feedback as $f) {
        if($f!=null){
            ?>
            <tr>
               <td><?=$f->id?></td>
               <td><?=$f->firstName?></td>
               <td><?=$f->lastName?></td>
               <td><?=$f->email?></td>
	       <td><?=$f->comments?></td>
			   
            </tr>
            <?php 
        }
    }
    ?>
    </table><br/><br/>
    <?php 
}
?>



<?php
include '../../includes/footer.php';
?>