<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
date_default_timezone_set('Asia/Seoul');

$que = "select * from TjoinTbl where userId = '".$_REQUEST['email']."'";
$res = mysql_query($que);
$row = mysql_fetch_array($res);
$cnt = mysql_num_rows($res);
if($cnt > 0){
    echo $row['seq'];
}else{
    echo "noJoin";
}