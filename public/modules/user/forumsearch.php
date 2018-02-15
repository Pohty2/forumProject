<?php
session_start();
session_regenerate_id(TRUE);
require_once '../../includes/autoload.php';

use classes\business\ThreadManager;
use classes\entity\thread;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';

function createPreview($text, $limit) {
    $text = preg_replace('/\[\/?(?:b|i|u|s|center|quote|url|ul|ol|list|li|\*|code|table|tr|th|td|youtube|gvideo|(?:(?:size|color|quote|name|url|img)[^\]]*))\]/', '', $text);
    
    if (strlen($text) > $limit) return substr($text, 0, $limit) . "...";
    return $text;
}

/**
 * if user click search this statement will attempt to select from the database the users with the user inputs
 * and if there are any, will loop through the records and display them in a HTML table.
 */
if(isset($_POST["submit"])){
    $search = $_POST['search'];
    $type = $_POST['type'];
    
    $TM=new ThreadManager();
    $threads=$TM->searchThread($search,$type);
}
else {
$TM= new ThreadManager();
$threads=$TM->getAllthreads();
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
    <div class="container-fluid" style="background-color: #E4E4E4; padding-bottom:400px;">
        <div class="row">  
        <form name="searchform" method="post" style="margin-left: 20px;" class="pure-form pure-form-stacked">         
            <div class="col-sm-6" style="margin:20px;">
                    <input type="text" name="search" placeholder="Search the forum" style="width:100%; height:35px;">
                </div>
            <div class="col-sm-2" style="margin-top:20px;">
                     <select name="type" style="height:35px;">
                          <option value="job opening">job opening</option>
                          <option value="discussion">discussion</option>
                        </select> 
                </div>
            <div class="col-sm-1" style="margin-top:20px;">
                    <input type="submit" name="submit" value="submit" class="btn btn-md btn-primary">
                </div>
			<div class="col-sm-1" style="margin-top:20px;">
				<a href='threadpost.php'>
					<button type="button" class="btn btn-md btn-default">Post</button>
				</a>      
        	</div>
        </form>
        </div>
        
   	

        <div class="row">
        	<div class="col-sm-11" style="background-color: #FFFFFF; border-radius: 5px; margin:30px;">
        <br/><p style="margin-left: 20px;">Below is your search result of Forum Topics</p>  
    <?php
    foreach ($threads as $thread) {
        if($thread!=null){
            $message=$thread->message;
            $message = createPreview($message, 20);            
            ?>
            <div class="col-sm-12">
                        <a href='viewtopic.php?Threadid=<?php echo $thread->threadid ?>'><h4 style="padding-left:20px;"><b><?=$thread->subject?></b></h4></a>
                        <h4 style="padding-left:20px;"><?=$message?></h4>                   
                        <hr style="display:block;margin-top: 0.5px;margin-bottom: 20px;margin: auto;border-style: inset;border-width: 1px; color:black;">
                    </div>
            <?php 
        }
    }
    ?>
    </table><br/><br/>

			</div>
		</div>
    </div>
<?php
include '../../includes/footer.php';
?>