<?php
session_start();
session_regenerate_id(TRUE);
include 'includes/security.php';
include 'includes/header.php';
?>
<!DOCTYPE html>
<html lang="en">
        <head>
          <title>Homepage with login</title>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        </head>
        <body>
<!--this is the main hero banner picture-->
        <div class="container" style="background-image: url(http://localhost/phpcrudsample/public/images/meeting.png); margin-botton:100px;">                
                <!--this is the message box and forum search-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-12" style="background-color:#D7D7D7;text-align:center; margin-top:50px; padding-bottom:10px;">
                                    <h3>You have 1 new messages(s)</h3>
                                    <a href="/phpcrudsample/public/modules/user/pmlist.php"><button type="button" class="btn btn-default btn-lg">View Inbox</button></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12" style="background-color: rgba(134, 134, 134, 0.9); text-align:center; margin-top:100px; padding-bottom:10px;">
                                    <h2><b>Quick search the forum</b></h2>
                                    <input type="text" name="forum" placeholder="Enter your search topic here" size="50"></br>
                                    <button type="button" class="btn btn-default btn-lg">Go</button>
                                </div>
                            </div>
                            
                        </div>
                        <!--this is the colleague search box-->
                        <div class="col-sm-6">
                            <div style="background-color:rgba(19, 126, 172, 0.9); margin:0-auto; margin-bottom: 80px; padding-bottom:20px;">
                                <h2 style="text-align: center; padding-top:20px;"><b>Search for colleagues</b></h2></br>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h5>First name</h5>
                                            <input type="text" name="FirstName" placeholder="Enter the first name here" style="width:85%">
                                        </div>
                                        <div class="col-sm-3">
                                            <h5>Last name</h5>
                                            <input type="text" name="LastName" placeholder="Enter the last name here" style="width:85%">
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-md btn-default" style="display:block; margin:0 auto; margin-top:20px;">Search</button>
                                <h3 style="text-align: center;"><b>View member directory</b></h3>
                                <h4 style="text-align: center;"><b><u>A B C D E F G H I J K L M N</u></b></h4>
                                <h4 style="text-align: center;"><b><u>O P Q R S T U V W X Y Z</u></b></h4>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h4>Search by country instead</h4>
                                        </div>
                                        <div class="col-sm-3" style="padding-top:8px;">
                                            <form>
                                                <select name="country" style="width:85%">
                                                    <option value="Singapore">Singapore</option>
                                                </select>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-md btn-default" style="display:block; margin:0 auto; margin-top:10px;">Search countries</button>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            </body>
            


<?php
include 'includes/footer.php';
?>
</html>