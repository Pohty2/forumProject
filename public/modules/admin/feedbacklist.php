<?php
session_start();
session_regenerate_id(TRUE);
require_once '../../includes/autoload.php';

use classes\business\UserManager;
use classes\entity\Feedback;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';

$UM=new UserManager();
$users=$UM->getAllUsers();
/**
 * If the function getallusers fetches at least one user.
 */
if(isset($users)){
    ?>
	<link rel="stylesheet" href="..\..\css\pure-release-1.0.0\pure-min.css">
    <br/><br/>Below is the list of Developers registered in community portal <br/><br/>
    <table class="pure-table pure-table-bordered" width="800">
            <tr>
			<thead>
               <th><b>Id</b></th>
               <th><b>First Name</b></th>
               <th><b>Last Name</b></th>
               <th><b>Email</b></th>
			   <th><b>Operation</b></th>
			   </thead>
            </tr>    
    <?php 
    foreach ($users as $user) {
        if($user!=null){
            ?>
            <tr>
               <td><?=$user->id?></td>
               <td><?=$user->firstName?></td>
               <td><?=$user->lastName?></td>
               <td><?=$user->email?></td>
			   <td>
					<a href='deleteuser.php?id=<?php echo $user->id ?>'>Delete</a>
			   </td>
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