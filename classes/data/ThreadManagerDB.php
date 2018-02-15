<?php
namespace classes\data;

use classes\entity\Thread;
use classes\entity\Threadmsg;
use classes\entity\Threadattach;
use classes\util\DBUtil;

/**
 * This is the usermanagerDB class, containing functions to interact with the database.
 */

class ThreadManagerDB
{
    public static function fillthread($row){
        $thread=new Thread();
        $thread->threadid=$row["Threadid"];
        $thread->subject=$row["subject"];
        $thread->message=$row["message"];
        $thread->userid=$row["userid"];
        $thread->type=$row["type"];
        return $thread;
    }
    public static function fillthreadmsg($row){
        $threadmsg=new Threadmsg();
        $threadmsg->threadmsgid=$row["Threadmsgid"];
        $threadmsg->threadid=$row["Threadid"];
        $threadmsg->userid=$row["userid"];
        $threadmsg->message=$row["message"];
        return $threadmsg;
    }
    public static function fillthreadattach($row){
        $threadattach=new Threadattach();
        $threadattach->threadattachid=$row["Threadattachid"];
        $threadattach->threadmsgid=$row["Threadmsgid"];
        $threadattach->userid=$row["userid"];
        $threadattach->message=$row["message"];
        return $threadattach;
    }
    /**
     * function to search user with parameters inserted by the html form.
     */
    
    public static function searchThread($search,$type){
        $threads[]=array();
        $conn=DBUtil::getConnection();
        $search=mysqli_real_escape_string($conn,$search);
        $type=mysqli_real_escape_string($conn,$type);
        $sql = "SELECT * FROM thread where subject like '%".$search."%' and message like '%".$search."%' and type = '$type'";        
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $thread=self::fillthread($row);
                $threads[]=$thread;
            }
        }
        $conn->close();
        return $threads;
    }
    /**
     * function to get all threads.
     */
    
    public static function getAllthreads(){
        $threads[]=array();
        $conn=DBUtil::getConnection();
        $sql="select * from thread";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $thread=self::fillthread($row);
                $threads[]=$thread;
            }
        }
        $conn->close();
        return $threads;
    }
    /**
     * function to get one thread.
     */
    public static function getThread($Threadid){
        $thread=NULL;
        $conn=DBUtil::getConnection();
        $threadid=mysqli_real_escape_string($conn,$Threadid);
        $sql = "SELECT * FROM thread where Threadid like '%".$Threadid."%'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()){
                $thread=self::fillthread($row);
                
            }
        }
        $conn->close();
        return $thread;
    }
    /**
     * function to get all thread comments.
     */
    
    public static function getAllcomments($id){
        $thread=NULL;
        $conn=DBUtil::getConnection();
        $id=mysqli_real_escape_string($conn,$id);
        $sql = "SELECT * FROM threadmsg where Threadid like '%".$id."%'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $thread=self::fillthreadmsg($row);
                $threads[]=$thread;
            }
        }
        $conn->close();
        return $threads;
    }
    /**
     * function to get all thread comment replies.
     */
    
    public static function getAllreplies($id){
        $thread=NULL;
        $threads[]=array();
        $conn=DBUtil::getConnection();
        $id=mysqli_real_escape_string($conn,$id);
        $sql = "SELECT * FROM threadattach where Threadmsgid like '%".$id."%'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $thread=self::fillthreadattach($row);
                $threads[]=$thread;
            }
        }
        $conn->close();
        return $threads;
    }
    
    public static function saveThread(thread $thread){
        $conn=DBUtil::getConnection();
        $sql="insert into thread (userid, subject, message, type) values (?,?,?,?)";        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $thread->userid, $thread->subject, $thread->message, $thread->type);
        $stmt->execute();
        if($stmt->errno!=0){
            printf("Error: %s.\n",$stmt->error);
        }
        $stmt->close();
        $conn->close();
        echo "Your thread has been posted successfully.";
        }
           
        public static function saveComment(threadmsg $thread){
            $conn=DBUtil::getConnection();
            $sql="insert into threadmsg (userid, Threadid, message ) values (?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iis", $thread->userid, $thread->threadid, $thread->message);
            $stmt->execute();
            if($stmt->errno!=0){
                printf("Error: %s.\n",$stmt->error);
            }
            $stmt->close();
            $conn->close();
            echo "Your comment has been posted successfully.";
        }
        
        public static function saveReply(threadattach $thread){
            $conn=DBUtil::getConnection();
            $sql="insert into threadattach (userid,Threadmsgid, message ) values (?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iis", $thread->userid, $thread->threadmsgid, $thread->message);
            $stmt->execute();
            if($stmt->errno!=0){
                printf("Error: %s.\n",$stmt->error);
            }
            $stmt->close();
            $conn->close();
            echo "Your reply has been posted successfully.";
        }
    /**
     * function to delete a user from the database.
     */
    public static function deleteThread($id){
        $conn=DBUtil::getConnection();
        $sql="DELETE from thread WHERE Threadid='$id';";
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