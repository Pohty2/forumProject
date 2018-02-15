<!-- Navigation Bar -->
<!DOCTYPE html>
<html lang="en">
        <head>
          <title>ABC Community Portal</title>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
          <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        </head>
    <!--this is the header-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12" style="background-image: url(http://localhost/phpcrudsample/public/images/header.png)">
                    <div class="row">
                    <img src="http://localhost/phpcrudsample/public/images/logo.png" align="left" style="padding:10px; padding-left:30px; padding-top:15px;" class="col-lg-1 col-sm-2">
                    <div class="col-lg-11 col-sm-10" style="margin-top:15px; margin-bottom:15px;">
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
  <a href="/phpcrudsample/public/home.php" class="w3-bar-item w3-button w3-mobile w3-light-blue">Home</a>
  <a href="/phpcrudsample/public/modules/user/updateprofile.php" class="w3-bar-item w3-button w3-mobile w3-light-blue">Update Profile</a>
  <a href="/phpcrudsample/public/modules/admin/userlist.php" class="w3-bar-item w3-button w3-mobile w3-light-blue">Administer Users</a>
  <a href="/phpcrudsample/public/modules/user/usersearch.php" class="w3-bar-item w3-button w3-mobile w3-light-blue">Search Users</a>
  <a href="/phpcrudsample/public/modules/user/viewprofile.php" class="w3-bar-item w3-button w3-mobile w3-light-blue">View Public Profile</a>
  <a href="/phpcrudsample/public/modules/user/pmlist.php" class="w3-bar-item w3-button w3-mobile w3-light-blue">View Inbox</a>
  <a href="/phpcrudsample/public/modules/user/forumsearch.php" class="w3-bar-item w3-button w3-mobile w3-light-blue">View Forum</a>
  <a href="/phpcrudsample/public/modules/feedback/feedbacklist.php" class="w3-bar-item w3-button w3-mobile w3-light-blue">View Feedback</a>
  <a href="/phpcrudsample/public/contactus.php" class="w3-bar-item w3-button w3-mobile w3-light-blue">Contact</a>
  <a href="/phpcrudsample/public/logout.php" class="w3-bar-item w3-button w3-right w3-red w3-mobile">Logout</a>
</div>
<?php 
   }else{
       /**
        * if user is not an admin.
        */
?>
  <a href="/phpcrudsample/public/home.php" class="w3-bar-item w3-button w3-mobile w3-light-blue">Home</a>
  <a href="/phpcrudsample/public/modules/user/updateprofile.php" class="w3-bar-item w3-button w3-mobile w3-light-blue">Update Profile</a>
  <a href="/phpcrudsample/public/modules/user/usersearch.php" class="w3-bar-item w3-button w3-mobile w3-light-blue">Search Users</a>
  <a href="/phpcrudsample/public/modules/user/viewprofile.php" class="w3-bar-item w3-button w3-mobile w3-light-blue">View Public Profile</a>
  <a href="/phpcrudsample/public/modules/user/pmlist.php" class="w3-bar-item w3-button w3-mobile w3-light-blue">View Inbox</a>
  <a href="/phpcrudsample/public/modules/user/forumsearch.php" class="w3-bar-item w3-button w3-mobile w3-light-blue">View Forum</a>
  <a href="/phpcrudsample/public/contactus.php" class="w3-bar-item w3-button w3-mobile w3-light-blue">Contact</a>
  <a href="/phpcrudsample/public/logout.php" class="w3-bar-item w3-button w3-right w3-red w3-mobile">Logout</a>
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
  <a href="/phpcrudsample/public/home.php" class="w3-bar-item w3-button w3-mobile w3-light-blue">Home</a>
  <a href="/phpcrudsample/public/aboutus.php" class="w3-bar-item w3-button w3-mobile w3-light-blue">About Us</a>
  <a href="/phpcrudsample/public/contactus.php" class="w3-bar-item w3-button w3-mobile w3-light-blue">Contact</a>
  <a href="/phpcrudsample/public/login.php" class="w3-bar-item w3-button w3-right w3-light-grey w3-mobile">Login</a>
</div>
<?php 
   } 
   
?>
	</div>
		</div>
   			</div>
       			</div>