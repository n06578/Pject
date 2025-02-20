<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';

// var_dump($_REQUEST);
$que = "select * from TdeclareTbl where joinSeq = '".$_SESSION['loginNum']."' and conSeq = '".$_REQUEST['conSeq']."' and Type = '".$_REQUEST['Type']."' and conType = '".$_REQUEST['conType']."'";
$res = mysql_query($que);
$cnt = mysql_num_rows($res);
if($cnt < 1){
    $que = "insert into TdeclareTbl set
                joinSeq = '".$_SESSION['loginNum']."',
                conSeq = '".$_REQUEST['conSeq']."',
                Type = '".$_REQUEST['Type']."',
                conType = '".$_REQUEST['conType']."',
                declareType='',
                declareReason = '".$_REQUEST['declareReason']."',
                clickDateTime = '".date("Y-m-d H:i:s")."'";
            
    mysql_query($que);
}else{
    $row = mysql_fetch_array($res);
    echo $row['clickDateTime'];
}