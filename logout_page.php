<?php
session_start();
$_SESSION = [];

/** untuk menghapus sesi (email, password dll) ketika logout **/
session_destroy();
header("location: login_page.php");
