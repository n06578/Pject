<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
$ip = '수정필요';
$que = "select * from TmoneAnswerTbl where moneSeq = '".$_REQUEST['seq']."'";
$res = mysql_query($que);
$cnt = mysql_num_rows($res);
if($cnt == 0){
$que = "insert into TmoneAnswerTbl set
		moneSeq = '".$_REQUEST['seq']."',
		answerDateTime = '".date("Y-m-d H:i:s")."',
		answerContents = '".$_REQUEST['moneContents']."',
		answerTitle = '".$_REQUEST['moneTitle']."',
		answerIp = '".$ip."'";
}else{
$que = "update TmoneAnswerTbl set
		answerDateTime = '".date("Y-m-d H:i:s")."',
		answerContents = '".$_REQUEST['moneContents']."',
		answerTitle = '".$_REQUEST['moneTitle']."',
		answerIp = '".$ip."'
		where moneSeq = '".$_REQUEST['seq']."'";
}
mysql_query($que);