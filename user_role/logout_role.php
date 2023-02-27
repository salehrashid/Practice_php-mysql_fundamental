<?php
session_start();
$_SESSION = [];

/** untuk menghapus sesi (email, password dll) ketika logout **/
session_destroy();
header("location: ../user_role/login_role.php");
