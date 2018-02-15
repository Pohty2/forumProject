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

$formerror="";
$firstName="";
$lastName="";
$email="";
$password="";
$number="";
$country="";
$city="";
$writeup="";

/**
 * fetches the user's information from the database using the session email set when the user logged in, to be echoed into the html table.
 */
$UM=new UserManager();
$existuser=$UM->getUserByEmail($_SESSION["email"]);
$firstName=$existuser->firstName;
$lastName=$existuser->lastName;
$email=$existuser->email;
$number=$existuser->number;
$country=$existuser->country;
$city=$existuser->city;
$writeup=$existuser->writeup;

?>
<html lang="en">
        <head>
          <title>Public profile page</title>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="..\..\css\pure-release-1.0.0\pure-min.css">
<style>
table, th, td {
    border: 1px solid black;
}
th, td {
    padding:10px;
}
</style>
</head>
<!--this is the main content area-->
    <div class="container-fluid" style="background-color:#FFFF80; padding-bottom:90px;">
        <div class="row">
        	<div class="col-sm-10" style="background-color: #8080FF; margin:20px; padding-bottom:20px;">
                <h1 style=" text-align: center;">Contact and personal info</h1>
                <div><?=$formerror?></div>
                <table width="1000" style="margin-left:40px; color:white;">
                  <tr>
                    <td>First Name:</td>
                    <td><?=$firstName?></td>
                  </tr>
                  <tr>
                    <td>Last Name:</td>
                    <td><?=$lastName?></td>
                  </tr>
                  <tr>
                    <td>Email:</td>
                    <td><?=$email?></td>
                  </tr>
                  <tr>
                    <td>Number:</td>
                    <td><?=$number?></td>
                  </tr>
                  <tr>
                    <td>Country:</td>
                    <td><?=$country?></td>
                  </tr>
                  <tr>
                    <td>City:</td>
                    <td><?=$city?></td>
                  </tr>
                  <tr>
                    <td>Writeup:</td>
                    <td><?=$writeup?></td>
                  </tr>
                </table>
            </div>
        </div>
    </div>
        

<?php
include '../../includes/footer.php';
?>