<?php
/**
 * checks for if the user access a part of the website without being logged in.
 */
if(!isset($_SESSION['email'])){
    header("Location:/phpcrudsample/public/login.php");
}
?>