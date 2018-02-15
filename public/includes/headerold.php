<!-- Navigation Bar -->
<?php 
/**
 * checks for if the user is logged in.
 */

   if(isset($_SESSION["email"]))
   {
       /**
        * checks if the user is an admin.
        */
	if($_SESSION['role']=='admin'){
?>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div class="w3-bar w3-black w3-large">
  <img src="http://localhost/phpcrudsample/public/images/logo.png" align="left" style="width:55px; height:35px">
  <a href="/phpcrudsample/public/home.php" class="w3-bar-item w3-button w3-mobile"><i class="fa fa-bed w3-margin-right"></i>Home</a>
  <a href="/phpcrudsample/public/modules/user/updateprofile.php" class="w3-bar-item w3-button w3-mobile">Update Profile</a>
  <a href="/phpcrudsample/public/modules/admin/userlist.php" class="w3-bar-item w3-button w3-mobile">Administer Users</a>
  <a href="/phpcrudsample/public/modules/user/usersearch.php" class="w3-bar-item w3-button w3-mobile">Search Users</a>
  <a href="/phpcrudsample/public/modules/user/viewprofile.php" class="w3-bar-item w3-button w3-mobile">View Public Profile</a>
  <a href="/phpcrudsample/public/modules/user/pmlist.php" class="w3-bar-item w3-button w3-mobile">View Inbox</a>
  <a href="/phpcrudsample/public/modules/feedback/feedbacklist.php" class="w3-bar-item w3-button w3-mobile">View Feedback</a>
  <a href="/phpcrudsample/public/contactus.php" class="w3-bar-item w3-button w3-mobile">Contact</a>
  <a href="/phpcrudsample/public/logout.php" class="w3-bar-item w3-button w3-right w3-light-grey w3-mobile">Logout</a>
</div>
<?php 
   }else{
       /**
        * if user is not an admin.
        */
?>

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div class="w3-bar w3-black w3-large">
  <img src="http://localhost/phpcrudsample/public/images/logo.png" align="left" style="width:55px; height:35px">
  <a href="/phpcrudsample/public/home.php" class="w3-bar-item w3-button w3-mobile"><i class="fa fa-bed w3-margin-right"></i>Home</a>
  <a href="/phpcrudsample/public/modules/user/updateprofile.php" class="w3-bar-item w3-button w3-mobile">Update Profile</a>
  <a href="/phpcrudsample/public/modules/user/usersearch.php" class="w3-bar-item w3-button w3-mobile">Search Users</a>
  <a href="/phpcrudsample/public/modules/user/viewprofile.php" class="w3-bar-item w3-button w3-mobile">View Public Profile</a>
  <a href="/phpcrudsample/public/modules/user/pmlist.php" class="w3-bar-item w3-button w3-mobile">View Inbox</a>
  <a href="/phpcrudsample/public/contactus.php" class="w3-bar-item w3-button w3-mobile">Contact</a>
  <a href="/phpcrudsample/public/logout.php" class="w3-bar-item w3-button w3-right w3-light-grey w3-mobile">Logout</a>
</div>

<?php
	} 
}
else
   {
       /**
        * if user is not logged in.
        */
?>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div class="w3-bar w3-black w3-large">
  <img src="http://localhost/phpcrudsample/public/images/logo.png" align="left" style="width:55px; height:35px">
  <a href="/phpcrudsample/public/home.php" class="w3-bar-item w3-button w3-mobile"><i class="fa fa-bed w3-margin-right"></i>Home</a>
  <a href="/phpcrudsample/public/aboutus.php" class="w3-bar-item w3-button w3-mobile"><i class="fa fa-bed w3-margin-right"></i>About Us</a>
  <a href="/phpcrudsample/public/contactus.php" class="w3-bar-item w3-button w3-mobile">Contact</a>
  <a href="/phpcrudsample/public/login.php" class="w3-bar-item w3-button w3-right w3-light-grey w3-mobile">Login</a>
</div>
<?php 
   } 
   
?>