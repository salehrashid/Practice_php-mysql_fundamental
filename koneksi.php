<?php
/**
 * Isi detail database
 */
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'sekolah';

/**
 *Check connection to the db
 **/
$connect = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($connect->errno) {
    echo $connect->error;
    exit;
} else{
    echo "Connection to Database succeeded";
}
