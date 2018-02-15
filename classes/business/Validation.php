<?php
namespace classes\business;

use classes\entity\User;
use classes\data\UserManagerDB;
/**
 * The class validation contains functions which check a user's input for errornous input such as special characters.
 */
class Validation
{
	public function check_name($input, &$error)
	{
		if (!preg_match("/^[a-zA-Z ]*$/",$input)) 
		{ 
			$error = "Only letters and white space allowed"; 
			return false;
		}
		return true;
	}
	
	public function check_password($input, &$error)
	{
		if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/",$input))
		{ 
			$error = "Password must consist of at least 6 characters with at least one uppercase letter, one lowercase letter and one digit, and not contain any special characters."; 
			return false;
		}
		return true;
	}
	public function check_email($input, &$error)
	{
	    if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/",$input))
	    {
	        $error = "Please enter a valid Email.";
	        return false;
	    }
	    return true;
	}
}
?>