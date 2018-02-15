<?php
namespace classes\util;

use mysqli;
/**
 * this is the dbutil class, which will be used in the php module files to connect and interact with the database.
 */
class DBUtil
{
    public static function getConnection(){
        $config=Config::getConfig();
        $conn = new mysqli($config->mysqlServer, $config->mysqlUser, $config->mysqlPassword,$config->mysqlDB);
        return $conn;
    }
}

