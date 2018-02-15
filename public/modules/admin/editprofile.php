<?php
session_start();
session_regenerate_id(TRUE);
require_once '../../includes/autoload.php';
require_once '../../includes/password.php';

use classes\business\UserManager;
use classes\entity\User;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';
?>

<?php

$formerror="";
$firstName="";
$lastName="";
$number="";
$country="";
$city="";
$writeup="";

/**
 * auto populates the fields of the form with the selected user's details, either with values fetched from the database, or the values inputted by the admin.
 */
if(!isset($_POST["submitted"])){
  $UM=new UserManager();
  $existuser=$UM->getUserByEmail($_GET["email"]);
  $firstName=$existuser->firstName;
  $lastName=$existuser->lastName;
  $number=$existuser->number;
  $country=$existuser->country;
  $city=$existuser->city;
  $writeup=$existuser->writeup;
}else{
  $firstName=$_POST["firstName"];
  $lastName=$_POST["lastName"];
  $number=$_POST["number"];
  $country=$_POST["country"];
  $city=$_POST["city"];
  $writeup=$_POST["writeup"];

  if($firstName!='' && $lastName!='' && $number!=''){
      /**
       * updates the database with the values entered in the fields by the admin.
       */
           $update=true;
           $UM=new UserManager();
           if($update){
               $existuser=$UM->getUserByEmail($_GET["email"]);
               $existuser->firstName=$firstName;
               $existuser->lastName=$lastName;
               $existuser->number=$number;
               $existuser->country=$country;
               $existuser->city=$city;
               $existuser->writeup=$writeup;
               $UM->saveUser($existuser);
               echo "<br> Your details have been updated.";
           }
  }else{
      $formerror="Please provide required values";
  }
}
?>
<link rel="stylesheet" href="..\..\css\pure-release-1.0.0\pure-min.css">
<form name="myForm" method="post" class="pure-form pure-form-stacked">
<h1 style="margin-left:20px;">Administer User Profile</h1>
<div><?=$formerror?></div>
<table width="800" style="margin-left:20px;">
  <tr>
    <td>First Name</td>
    <td><input type="text" name="firstName" value="<?=$firstName?>" size="50"></td>
  </tr>
  <tr>
    <td>Last Name</td>
    <td><input type="text" name="lastName" value="<?=$lastName?>" size="50"></td>
  </tr>
  <tr>
    <td>Number</td>
    <td><input type="text" name="number" value="<?=$number?>" size="50"></td>
  </tr>
  <tr>
    <td>Country</td>
    <td><input type="text" name="country" value="<?=$country?>" size="50"></td>
  </tr>
  <tr>
    <td>City</td>
    <td><input type="text" name="city" value="<?=$city?>" size="50"></td>
  </tr>
  <tr>
    <td>Writeup</td>
    <td><textarea name="writeup" rows="3" style="resize:none;" cols="48"><?=$writeup?></textarea></td>
  </tr>
  <tr>
	<td></td>
    <td><input type="submit" name="submitted" value="Submit" class="pure-button pure-button-primary">
    <input type="reset" name="reset" value="Reset" class="pure-button pure-button-primary"></td>
    </td>
  </tr>
</table>
</form>


<?php
include '../../includes/footer.php';
?>