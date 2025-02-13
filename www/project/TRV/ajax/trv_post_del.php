<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
if($_REQUEST['conType']=="gongji"){
    $que_main = "select seq from TgongjiTbl where seq = '".$_REQUEST['seq']."'";
}else if($_REQUEST['conType']=="commu"){
    $que_main = "select seq from TcommuniTbl where seq = '".$_REQUEST['seq']."'";
}
$que_ans = "select seq from TcommuniAnswerTbl where conSeq in (".$que_main.") and conType='".$_REQUEST['conType']."'";
$que_lh = "select seq from TlikeHateTbl where conSeq in (".$que_ans.") and conType='".$_REQUEST['conType']."'";


$del_lh = "DELETE FROM TlikeHateTbl WHERE conSeq IN ($que_ans) AND conType='".$_REQUEST['conType']."'";
$del_ans = "DELETE FROM TcommuniAnswerTbl WHERE conSeq IN ($que_main) AND conType='".$_REQUEST['conType']."'";
$del_main = str_replace("select seq","delete",$que_main);

// 실행
mysql_query($del_lh);
mysql_query($del_ans);
mysql_query($del_main);

?>