<?php
session_start();
session_regenerate_id(TRUE);
require_once '../../includes/autoload.php';

use classes\business\UserManager;
use classes\entity\User;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';

/**
 * if user clicks the search button.
 */
if(isset($_POST["search"])){
    /**
     * search is performed using the values submmitted by the user.
     */
    $Fname = $_POST['Fname'];
    $Lname = $_POST['Lname'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    
    $UM=new UserManager();
    $users=$UM->searchUser($Fname,$Lname,$email,$number,$country,$city);
}

?>
	<!DOCTYPE html>
	<html lang="en">
        <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		  <link rel="stylesheet" href="..\..\css\pure-release-1.0.0\pure-min.css">
		</head>
	<br><br>
	<!--this is the main content area-->
    <div class="container" style="background-image: url(http://localhost/phpcrudsample/public/images/handshake.gif); margin-botton:400px;">
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10" style="background-color:rgba(188, 188, 188, 0.8); margin-top:20px;">
                <div class="row" style=" margin-top:10px;">
                    <div class="col-sm-12">
                        <h3 style="text-align: center"><b>Search for colleagues or acquaintances</b></h3>
                    </div>
                </div>
                <div class="row" style=" margin-top:10px;">                                             
                <form name="searchform" method="post" style="margin-left: 20px;" class="pure-form pure-form-stacked">
                <table>
            	<tr>
            		<td>First Name:</td>
            		<td><input type="text" name="Fname"></td>
            		<td>Last Name:</td>
            		<td><input type="text" name="Lname"></td>
            		<td>Email:</td>
            		<td><input type="text" name="email"></td>
            	</tr>
            	<tr>
            		<td>Number:</td>
            		<td><input type="text" name="number"></td>
            		<td>Country:</td>
            		<td><input type="text" name="country"></td>
            		<td>City:</td>
            		<td><input type="text" name="city"></td>
            	</tr>
            	<tr>
            		<td><input type="submit" name="search" value="search"></td>
            		<td><input type="submit" onclick="clearFields()" value="Clear Search Results"></td>
            	</tr>
            	</table>
            	</form>
            </div>
            	<script type="text/javascript">
            	function clearFields() {
                document.getElementByName("searchform").reset();
            	}
            	</script>
    		</div>
        </div> 
    </div>	
    <?php
    /**
     * if user click search this statement will attempt to select from the database the users with the user inputs
     * and if there are any, will loop through the records and display them in a HTML table.
     */
    if(isset($_POST["search"])){
        ?>
        <br/><p style="margin-left: 20px;">Below is your search result of Developers registered in community portal</p>
        <?php
        echo "<p style='margin-left: 20px;'>You searched for First name: $Fname, Last name: $Lname, Email: $email, Number: $number, Country: $country and City: $city<p>"
        ?>
        <table class="pure-table pure-table-bordered" width="1200" style="margin-left: 20px; background-color:white;">
            <tr>
			<thead>
               <th><b>Id</b></th>
               <th><b>First Name</b></th>
               <th><b>Last Name</b></th>
               <th><b>Email</b></th>
			   <th><b>Number</b></th>
			   <th><b>Country</b></th>
			   <th><b>City</b></th>
			   <th><b>Writeup</b></th>
			   <th><b>Action</b></th>
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
			   <td><?=$user->number?></td>
			   <td><?=$user->country?></td>
			   <td><?=$user->city?></td>
			   <td><?=$user->writeup?></td>
			   <td><?php if($user->id==$_SESSION['id']){?>
					You cannot send a message to yourself
					<?php }else{?>
					<a href='sendmsg.php?id=<?php echo $user->id ?>'>Send message</a></td>
					<?php }?>
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