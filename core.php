<?php
$title = "2hohoho.de";
$loggedin_username = "";
$loggedin = "";

$adminlist = array('2hohoho', 'Administrator');
list($Admin_Administrator, $Admin_2hohoho) = $adminlist;

$mysql_host = "127.0.0.1";
$mysql_username = "root";
$mysql_database = "web_users";
$mysql_password = "10Z3Ipr8";

$pdo = new PDO("mysql:host=" . $mysql_host . ";dbname=" . $mysql_database, $mysql_username, $mysql_password);
?>
