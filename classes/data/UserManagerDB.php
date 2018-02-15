<?php
namespace classes\data;

use classes\entity\User;
use classes\util\DBUtil;

/**
 * This is the usermanagerDB class, containing functions to interact with the database.
 */

class UserManagerDB
{
    /**
     * filluser function fetches the data retrieved from the database and automatically returns them in an array.
     */
    
    public static function fillUser($row){
        $user=new User();
        $user->id=$row["id"];
        $user->firstName=$row["firstname"];
        $user->lastName=$row["lastname"];
        $user->email=$row["email"];
        $user->password=$row["password"];
	$user->account_creation_time = $row["account_creation_time"];
	$user->role = $row["role"];
	$user->number = $row["number"];
	$user->country = $row["country"];
	$user->city = $row["city"];
	$user->writeup = $row["writeup"];
        return $user;
    }
    /**
     * function to get user by email and password.
     */
    
    public static function getUserByEmailPassword($email,$password){
        $user=NULL;
        $conn=DBUtil::getConnection();
        $email=mysqli_real_escape_string($conn,$email);
        $password=mysqli_real_escape_string($conn,$password);
        $sql="select * from tb_user where email='$email' and password='$password'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()){
                $user=self::fillUser($row);
            }
        }
        $conn->close();
        return $user;
    }
    /**
     * function to get user by email.
     */
    
    public static function getUserByEmail($email){
        $user=NULL;
        $conn=DBUtil::getConnection();
        $email=mysqli_real_escape_string($conn,$email);
        $sql="select * from tb_user where Email='$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()){
                $user=self::fillUser($row);
            }
        }
        $conn->close();
        return $user;
    }
    /**
     * function to search user with parameters inserted by the html form.
     */
    
	public static function searchUser($Fname,$Lname,$email,$number,$country,$city){
        $user=NULL;
        $conn=DBUtil::getConnection();
        $Fname=mysqli_real_escape_string($conn,$Fname);
        $Lname=mysqli_real_escape_string($conn,$Lname);
        $email=mysqli_real_escape_string($conn,$email);
        $number=mysqli_real_escape_string($conn,$number);
        $country=mysqli_real_escape_string($conn,$country);
        $city=mysqli_real_escape_string($conn,$city);
        $sql = "SELECT * FROM tb_user where firstname like '%".$Fname."%' and lastname like '%".$Lname."%' and email like '%".$email."%'and number like '%".$number."%'and country like '%".$country."%'and city like '%".$city."%'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $user=self::fillUser($row);
                $users[]=$user;
            }
        }
        $conn->close();
        return $users;
    }
    /**
     * function to get all users.
     */
    
    public static function getAllUsers(){
        $users[]=array();
        $conn=DBUtil::getConnection();
        $sql="select * from tb_user";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $user=self::fillUser($row);
                $users[]=$user;
            }
        }
        $conn->close();
        return $users;
    }
    /**
     * function to get user by ID.
     */
	public static function getUserById($id){
        $user=NULL;
        $conn=DBUtil::getConnection();
        $id=mysqli_real_escape_string($conn,$id);
        $sql="select * from tb_user where id='$id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()){
                $user=self::fillUser($row);
            }
        }
        $conn->close();
        return $user;
    }
    /**
     * function to get user's first name by ID.
     */
    public static function getFirstNameById($id){
        $user=NULL;
        $conn=DBUtil::getConnection();
        $id=mysqli_real_escape_string($conn,$id);
        $sql="select FirstName from tb_user where id='$id'";
        $result = $conn->query($sql);
        if($row = $result->fetch_assoc()){
        $final=$row["FirstName"];
        }
        $conn->close();
        return $final;
    }
    /**
     * function to save user into the database.
     */
    public static function saveUser(User $user){
        $conn=DBUtil::getConnection();
        $sql="call procSaveUser(?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issssssssss", $user->id,$user->firstName, $user->lastName, $user->email,$user->password, $user->account_creation_time, $user->role, $user->number, $user->country, $user->city, $user->writeup); 
        $stmt->execute();
        if($stmt->errno!=0){
            printf("Error: %s.\n",$stmt->error);
        }
        $stmt->close();
        $conn->close();
        }
        /**
         * function to change password with user's input.
         */
    public static function updatePassword($email,$password){
        $conn=DBUtil::getConnection();
        $sql="UPDATE tb_user SET password='$password' WHERE email='$email';";
        $stmt = $conn->prepare($sql);
		if ($conn->query($sql) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
		$conn->close();

    }	
    /**
     * function to delete a user from the database.
     */
    public static function deleteAccount($id){
        $conn=DBUtil::getConnection();
        $sql="DELETE from tb_user WHERE id='$id';";
        $stmt = $conn->prepare($sql);
		if ($conn->query($sql) === TRUE) {
			echo "<script>alert(Record deleted successfully)</script>";
		} else {
			echo "Error updating record: " . $conn->error;
		}
		$conn->close();

    }		
    
}

?>