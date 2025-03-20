<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';

$que = "update TjoinTbl set  userPassWord='".$_REQUEST['userPassWord']."' where userName = '".$_REQUEST['userName']."' and userName = '".$_REQUEST['userName']."'";
mysql_query($que);

echo "changeDone";