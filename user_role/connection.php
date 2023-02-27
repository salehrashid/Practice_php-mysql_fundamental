<?php
/**
 * Isi detail database
 */
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'userRole';

/**
 *Check connection to the db
 **/
$connectMySql = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($connectMySql->errno) {
    echo $connectMySql->error;
    exit;
} else{
    echo "Connection to Database succeeded";
}
