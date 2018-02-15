<?php
namespace classes\business;

use classes\data\ThreadManagerDB;
use classes\entity\Thread;
use classes\entity\Threadmsg;
use classes\entity\Threadattach;
/**
 * The class threadmanager calls on the functions in the threadmanagerDB file.
 */
class ThreadManager
{
    public static function getAllthreads(){
        return ThreadManagerDB::getAllthreads();
    }
    public static function getThread($id){
        return ThreadManagerDB::getThread($id);
    }
    public static function getAllreplies($id){
        return ThreadManagerDB::getAllreplies($id);
    }
    public static function getAllcomments($id){
        return ThreadManagerDB::getAllcomments($id);
    }
    public function searchThread($search,$type){
        return ThreadManagerDB::searchThread($search,$type);
    }
    public function saveThread(thread $thread){
        ThreadManagerDB::saveThread($thread);
    }
    public function saveComment(threadmsg $thread){
        ThreadManagerDB::saveComment($thread);
    }
    public function saveReply(threadattach $thread){
        ThreadManagerDB::saveReply($thread);
    }
    public function commentCount($threadid){
        ThreadManagerDB::commentCount($threadid);
    }
    public function deleteThread($id){
        ThreadManagerDB::deleteThread($id);
    }
}

?>