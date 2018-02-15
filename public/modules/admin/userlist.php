<?php
session_start();
session_regenerate_id(TRUE);
require_once '../../includes/autoload.php';

use classes\business\UserManager;
use classes\entity\User;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';

$UM=new UserManager();
$users=$UM->getAllUsers();
/**
 * if the function getallusers fetches at least one user.
 */
if(isset($users)){
    ?>
	<link rel="stylesheet" href="..\..\css\pure-release-1.0.0\pure-min.css">
    <br/><br/><p style="margin-left: 20px; font-size:25px;">Below is the list of Developers registered in community portal</p>
    <table class="pure-table pure-table-bordered" width="900" style="margin-left: 20px; margin-bottom: 20px;">
            <tr>
			<thead>
               <th><b>Id</b></th>
               <th><b>First Name</b></th>
               <th><b>Last Name</b></th>
               <th><b>Email</b></th>
               <th><b>Role</b></th>
			   <th><b>Operation</b></th>
			   </thead>
            </tr>    
    <?php 
    foreach ($users as $user) {
        if($user!=null){
            /**
             * echoes out each user in a row.
             */
            ?>
            <tr>
               <td><?=$user->id?></td>
               <td><?=$user->firstName?></td>
               <td><?=$user->lastName?></td>
               <td><?=$user->email?></td>
               <td><?=$user->role?></td>
			   <td><?php if($user->id==$_SESSION['id']){?>
					You cannot delete yourself
					<?php }else{?>
					<a href='editprofile.php?email=<?php echo $user->email ?>'>Edit</a> /
					<a href='deleteuser.php?id=<?php echo $user->id ?>'>Delete</a>
					<?php }?>
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