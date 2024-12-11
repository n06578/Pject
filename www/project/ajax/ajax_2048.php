<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
echo $_SERVER["REMOTE_ADDR"];
$score =  $_REQUEST["scrore"];

$que = "select * from miniGame where ip ='".$_SERVER["REMOTE_ADDR"]."'";
$res = mysql_query($que);
$cnt = mysql_num_rows($res);

if($cnt > 0){
    $que = "update miniGame set score = '".$score."' where ip='".$_SERVER["REMOTE_ADDR"]."'";
}else{
    $que = "insert into miniGame set ip ='".$_SERVER["REMOTE_ADDR"]."',score = '".$score."'";
}
mysql_query($que);